<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Event observers used in tool_groupautoenrol.
 *
 * @package    tool_groupautoenrol
 * @copyright  2016 Pascal
 * @author     Pascal M - https://github.com/pascal-my
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_groupautoenrol;

use core\event\user_enrolment_created;
use stdClass;

/**
 * Event observer for tool_groupautoenrol.
 *
 * @package    tool_groupautoenrol
 * @copyright  2016 Pascal
 * @author     Pascal M - https://github.com/pascal-my
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class observer {
    /**
     * Triggered via core\event\user_enrolment_created (user_enrolled)
     * Action when user is enrolled
     *
     * @param user_enrolment_created $event
     *
     * @return bool true if all ok
     */
    public static function user_is_enrolled(user_enrolment_created $event): bool {
        global $CFG, $DB;
        require_once($CFG->dirroot . '/group/lib.php');
        $enroldata = $event->get_record_snapshot($event->objecttable, $event->objectid);
        $groupautoenrol = $DB->get_record('tool_groupautoenrol', ['courseid' => $event->courseid]);

        if (empty($groupautoenrol->enable_enrol)) {
            return true;
        }

        $groupstouse = self::get_course_groups($groupautoenrol, $event);

        // Checking if there is at least 1 group.
        if (empty($groupstouse)) {
            return true;
        }

        // Checking if user is not already into these groups.
        if (self::user_is_group_member($groupstouse, $enroldata)) {
            return true;
        }

        self::add_user_to_group($groupautoenrol, $groupstouse, $enroldata);

        return true;
    }

    /**
     * Get the groups to use for the course.
     *
     * Groups are read from the cached course group data on purpose. Since Moodle 4.2,
     * groups_get_all_groups() filters groups by their membership visibility for the
     * current user. During self enrolment the current user is the student, who is not
     * yet a member of any group and lacks moodle/course:viewhiddengroups, so groups
     * with restricted visibility would be hidden and the user would not be assigned.
     *
     * @param stdClass $groupautoenrol
     * @param user_enrolment_created $event
     *
     * @return array
     */
    private static function get_course_groups(stdClass $groupautoenrol, user_enrolment_created $event): array {
        $allgroupscourse = groups_get_course_data($event->courseid)->groups;

        if (empty($groupautoenrol->use_groupslist)) {
            // If use_groupslist == 0, use all groups of the course.
            return $allgroupscourse;
        }

        // If use_groupslist == 1, only use the listed groups that still exist
        // (when a group is deleted, the groupautoenrol table is not updated).
        $groupstouse = [];
        foreach (explode(',', (string) $groupautoenrol->groupslist) as $groupid) {
            if (empty($allgroupscourse[$groupid])) {
                continue;
            }

            $groupstouse[] = $allgroupscourse[$groupid];
        }

        return $groupstouse;
    }

    /**
     * Add user to group.
     *
     * @param stdClass $groupautoenrol
     * @param array $groupstouse
     * @param stdClass $enroldata
     */
    private static function add_user_to_group(stdClass $groupautoenrol, array $groupstouse, stdClass $enroldata): void {
        global $DB;

        if (!empty($groupautoenrol->enrol_method)) {
            // 0 = random, 1 = alpha, 2 = balanced.
            $enrolleduser = $DB->get_record('user', ['id' => $enroldata->userid], 'id, lastname', MUST_EXIST);

            if (empty($enrolleduser->lastname)) {
                return;
            }

            foreach ($groupstouse as $group) {
                $groupname = $group->name;

                if (strlen($groupname) < 2) {
                    continue;
                }

                if (
                    ($groupname[strlen($groupname) - 2] <= $enrolleduser->lastname[0]) &&
                    ($groupname[strlen($groupname) - 1] >= $enrolleduser->lastname[0])
                ) {
                    groups_add_member($group->id, $enroldata->userid);
                    break;
                }
            }
        } else {
            // Array_rand return key not value!
            $randkeys = array_rand($groupstouse);
            $group2add = $groupstouse[$randkeys];
            groups_add_member($group2add, $enroldata->userid);
        }
    }

    /**
     * Check if user is already in one of the groups.
     *
     * @param array $groupstouse
     * @param stdClass $enroldata
     *
     * @return bool
     */
    private static function user_is_group_member(array $groupstouse, stdClass $enroldata): bool {
        foreach ($groupstouse as $group) {
            if (groups_is_member($group->id, $enroldata->userid)) {
                return true;
            }
        }

        return false;
    }
}
