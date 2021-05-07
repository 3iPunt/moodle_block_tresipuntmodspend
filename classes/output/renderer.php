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

namespace block_tresipuntmodspend\output;
defined('MOODLE_INTERNAL') || die();

use moodle_exception;
use plugin_renderer_base;

/**
 * Block Tresipunt Modules Pending Renderer.
 *
 * @package    block_tresipuntmodspend
 * @copyright  2021 Tresipunt
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class renderer extends plugin_renderer_base {

    /**
     * Defer to template.
     *
     * @param main_content $maincontent
     * @return bool|string
     * @throws moodle_exception
     */
    public function render_main_content(main_content $maincontent) {
        $data = $maincontent->export_for_template($this);
        return parent::render_from_template('block_tresipuntmodspend/main_content', $data);
    }

    /**
     * Defer to template.
     *
     * @param tasks_page $page
     * @return bool|string
     * @throws moodle_exception
     */
    public function render_tasks_page(tasks_page $page) {
        $data = $page->export_for_template($this);
        return parent::render_from_template('block_tresipuntmodspend/tasks_page', $data);
    }

}
