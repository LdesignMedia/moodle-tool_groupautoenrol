## Moodle - Tool Group Auto Enrol

[![CI Status](https://github.com/LdesignMedia/moodle-tool_groupautoenrol/workflows/ci/badge.svg)](https://github.com/LdesignMedia/moodle-tool_groupautoenrol/actions/workflows/ci.yml)

Automatically enrol students into course groups when they join a course. Works with all enrolment methods (manual, self-enrolment, cohort sync) and randomly assigns users to ensure balanced group distribution.

## Author
<img src="https://ldesignmedia.nl/themes/ldesignmedia/assets/images/logo/logo.svg" alt="ldesignmedia" height="70px">

* Author: Pascal M, [https://github.com/pascal-my](https://github.com/pascal-my)
* Author: Luuk Verhoeven, [ldesignmedia.nl](https://ldesignmedia.nl/)
* Author: Gemma Lesterhuis, [LTNC B.V.](https://ltnc.nl/)
* Min. required: Moodle 4.5
* Supports PHP: 8.1+

![Moodle405](https://img.shields.io/badge/moodle-4.5-F98012.svg?logo=moodle)
![Moodle500](https://img.shields.io/badge/moodle-5.0-F98012.svg?logo=moodle)
![Moodle501](https://img.shields.io/badge/moodle-5.1-F98012.svg?logo=moodle)

![PHP81](https://img.shields.io/badge/PHP-8.1-777BB4.svg?logo=php)
![PHP82](https://img.shields.io/badge/PHP-8.2-777BB4.svg?logo=php)

![Privacy-friendly](https://img.shields.io/badge/Privacy-friendly-brightgreen.svg)

## List of features
- Automatically enrols students into groups when they join a course
- Works with all enrolment methods (manual, self-enrolment, cohort sync)
- Random assignment to ensure balanced group distribution
- Per-course enable/disable configuration
- Choice to auto-enrol in all existing groups or specific ones
- GDPR compliant implementation
- Course-level management through "Course administration > Users > Auto-enrol in groups"

## Installation
1. Copy this plugin to the `admin/tool/groupautoenrol` folder on the server
2. Login as administrator
3. Go to Site Administrator > Notification
4. Install the plugin
5. Create groups in your course(s)
6. Enable the plugin for specific courses via "Course administration > Users > Auto-enrol in groups"

## Security

If you discover any security related issues, please email [luuk@ldesignmedia.nl](mailto:luuk@ldesignmedia.nl) instead of using the issue tracker.

## License

The GNU GENERAL PUBLIC LICENSE. Please see [License File](LICENSE) for more information.

## Contributing

Contributions are welcome and will be fully credited. We accept contributions via Pull Requests on Github.

## Credits

* @copyright 2016 Pascal
* @author Pascal M - https://github.com/pascal-my
* @author Luuk Verhoeven - https://github.com/luukverhoeven

## Changelog

See [CHANGELOG.md](CHANGELOG.md) for a full list of changes.
