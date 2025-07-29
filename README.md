## Moodle tool for automatically enrolling students into course groups

In brief, groupautoenrol randomly assigns students to course groups when they are
enrolled in a course (via any enrollment method: auto-enrol by key, cohort sync, or manual enrolment).

* Author: Pascal M, [https://github.com/pascal-my](https://github.com/pascal-my)
* Author: Luuk Verhoeven [LdesignMedia](https://ldesignmedia.nl/)
* Author: Gemma Lesterhuis [LTNC B.V.](https://ltnc.nl/)
* Min. required: Moodle 3.9
* Supports PHP: 7.4

![Moodle39](https://img.shields.io/badge/moodle-3.9-brightgreen.svg)
![Moodle42](https://img.shields.io/badge/moodle-4.2-brightgreen.svg)
![Moodle43](https://img.shields.io/badge/moodle-4.3-brightgreen.svg)
![Moodle44](https://img.shields.io/badge/moodle-4.4-brightgreen.svg)
![Moodle45](https://img.shields.io/badge/moodle-4.5-brightgreen.svg)
![Moodle50](https://img.shields.io/badge/moodle-5.0-brightgreen.svg)

![PHP74](https://img.shields.io/badge/php-7.4-teal.svg)
![PHP80](https://img.shields.io/badge/php-8.0-teal.svg)
![PHP81](https://img.shields.io/badge/php-8.1-teal.svg)

## Features

### Core Functionality

- Automatically enrolls students into groups when they join a course
- Works with all enrollment methods (manual, self-enrollment, cohort sync)
- Random assignment to ensure balanced group distribution
- Per-course configuration

### Technical Details

- Uses `\core\event\user_enrolment_created` (user_enrolled) Moodle event
- Safely handles deleted groups (ignores them during assignment)
- GDPR compliant implementation
- Admin tool plugin architecture for better integration

### Configuration Options

- Enable/disable plugin per course
- Choose to auto-enrol in all existing groups or specific ones
- Course-level management through "Course administration > Users > Auto-enrol in groups"

## Installation

1. Copy this plugin to the `admin/tool/groupautoenrol` folder on the server
2. Login as administrator
3. Go to Site Administrator > Notification
4. Install the plugin
5. Create groups in your course(s)
6. Enable the plugin for specific courses via "Course administration > Users > Auto-enrol in groups"

Note: The "Auto-enrol in groups" link appears even if the plugin is not enabled for the course.

## Testing the Plugin

1. **Create test groups**: Navigate to a course and create multiple groups via Course administration > Participants >
   Groups
2. **Enable auto-enrollment**: Go to Course administration > Users > Auto-enrol in groups and enable the feature
3. **Test enrollment methods**:
    - Manual enrollment: Add users manually and verify group assignment
    - Self-enrollment: Have users self-enroll using an enrollment key
    - Cohort sync: Add users via cohort synchronization
4. **Verify results**: Check Course administration > Participants > Groups to confirm users were randomly assigned

## Compatibility

- Tested with Moodle 3.9 - 5.0
- PHP 7.4, 8.0, 8.1 support
- Previous versions available for older Moodle releases

## Version History

- **5.0.0**: Added support for Moodle 5.0
- **4.5.0**: Moodle 4.5 & PHP 8.1 version (stable release, June 2024)
- **4.4.0**: Moodle 4.4 version
- **4.3.0**: Moodle 4.3 version
- **4.2.1**: Fix issue #2 - Increased size of groupslist column
- **4.2.0**: Moodle 4.2 & PHP 8.0/8.1 version
- **3.9.0**: Moodle 3.9 & PHP 7.2 | Moodle 4.0 & PHP 7.4 | Moodle 4.1 & PHP 8.0
- **1.1.2**: Stable version as admin tool plugin for Moodle 3.x
- **1.1.1**: Stable version as local plugin for Moodle 2.x (
  see [moodle-local_groupautoenrol](https://github.com/pascal-my/moodle-local_groupautoenrol/tree/STABLE))
- **1.1**: Initial stable version (had bugs)

### Key Features in 4.5.0

- GDPR implementation
- Per-course enable/disable option
- Choice to auto-enrol in all existing groups or specific ones

## Bug and Problem Support

This plugin is carefully developed and thoroughly tested, but bugs and problems can always appear.
If you discover any security related issues, please email [support@ldesignmedia.nl](mailto:support@ldesignmedia.nl) instead of using the
issue tracker.

Please bear in mind that bug and problem support is not free of charge. This is with the exception of developers that
report and suggest a solution by creating a pull request.

## Feature Proposals

We are aware that members of the community will have other needs and would love to see them solved by this plugin. We
are always interested to read about your feature proposals or even get a pull request from you, but please understand
that we handle these as feature proposals and not as feature requests that we commit to implementing.

## License

Group Auto Enrol code is provided freely as open source software, under version 3 of the GNU General Public License.

## Contributing

Contributions are welcome and will be fully credited. We accept contributions via Pull Requests on GitHub.

## Credits

* @copyright 2016 Pascal
* @author Pascal M - https://github.com/pascal-my
* @author LTNC - https://ltnc.nl
* @author Luuk Verhoeven - https://github.com/luukverhoeven
