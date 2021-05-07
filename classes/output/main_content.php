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
 * Block Tresipunt Modules Pending renderable
 *
 * @package    block_tresipuntmodspend
 * @copyright  2021 Tresipunt
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_tresipuntmodspend\output;
defined('MOODLE_INTERNAL') || die();

use coding_exception;
use context_course;
use moodle_exception;
use moodle_url;
use renderable;
use renderer_base;
use stdClass;
use templatable;

/**
 * Main_content renderable class.
 *
 * @package    block_tresipuntmodspend
 * @copyright  2021 Tresipunt
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class main_content implements renderable, templatable {

    /**
     * Export for Template.
     *
     * @param renderer_base $output
     * @return stdClass
     * @throws coding_exception
     * @throws moodle_exception
     */
    public function export_for_template(renderer_base $output): stdClass {
        global $USER;

        $teacher = null;
        $student = null;
        $roles_user = [];

        $courses = enrol_get_all_users_courses($USER->id, true);
        foreach ($courses as $course) {
            $coursecontext = context_course::instance($course->id);
            $roles = get_user_roles($coursecontext);
            foreach ($roles as $role) {
                if (!in_array($role->shortname, $roles_user)) {
                    $roles_user[] = $role->shortname;
                }
            }
        }

        if (in_array('editingteacher', $roles_user)) {
            $teacher = $this->get_data_by_rolename('editingteacher');
        }

        if (in_array('student', $roles_user)) {
            $student = $this->get_data_by_rolename('student');
        }

        $data = new stdClass();
        $data->teacher = $teacher;
        $data->student = $student;
        return $data;
    }

    /**
     * Get Data by Rolename
     *
     * @param string $rolename
     * @return stdClass
     * @throws moodle_exception
     * @throws coding_exception
     */
    protected function get_data_by_rolename(string $rolename) {
        $url = new moodle_url('/theme/cbe/view_modspend.php', ['rolename' => $rolename]);
        $data = new stdClass();
        $data->url = $url->out(false);
        $data->text = get_string($rolename . '_button', 'block_tresipuntmodspend');
        return $data;
    }
}

