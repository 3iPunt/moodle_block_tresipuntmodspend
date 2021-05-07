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
 * Block Tresipunt Modules Pending.
 *
 * @package    block_tresipuntmodspend
 * @copyright  2021 Tresipunt
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use block_tresipuntmodspend\output\main_content;

defined('MOODLE_INTERNAL') || die();

/**
 * Block Tresipunt Modules Pending.
 *
 * @package    block_tresipuntmodspend
 * @copyright  2021 Tresipunt
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_tresipuntmodspend extends block_base {

    /**
     * Applicable formats.
     *
     * @return bool[]
     */
    public function applicable_formats() {
        return array('all' => true);
    }

    /**
     * Init.
     *
     * @throws coding_exception
     */
    public function init() {
        $this->title = get_string('pluginname', 'block_tresipuntmodspend');
    }

    /**
     * @return bool
     */
    function has_config() {
        return true;
    }

    /**
     * Hide Header
     *
     * @return boolean
     */
    public function hide_header(): bool {
        return true;
    }

    /**
     * Get content.
     *
     * @return stdClass|stdObject|null
     * @throws coding_exception
     */
    public function get_content() {
        global $COURSE;
        if (isset($this->content)) {
            return new stdClass();
        }
        $this->content = new stdClass();
        if (isloggedin() && !isguestuser() && isset($COURSE->id)) {
            $this->page->requires->css('/blocks/tresipuntmodspend/styles.css');
            $renderer = $this->page->get_renderer('block_tresipuntmodspend');
            $main_content = new main_content();
            $this->content->text = $renderer->render($main_content);
            $this->content->footer = '';
        }
        return $this->content;
    }
}
