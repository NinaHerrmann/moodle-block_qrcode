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
 * This file contains the renderer for the QR code block.
 *
 * @package block_qrcode
 * @copyright 2017 T Gunkel
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;
require_once('block_qrcode_form.php');

/**
 * Class block_qrcode_renderer
 *
 * @package block_qrcode
 * @copyright 2017 T Gunkel
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_qrcode_renderer extends plugin_renderer_base {

    /**
     * Returns a QR code as html image.
     * @param $image QR code
     * @return string html-string
     */
    public function display_image($url, $courseid, $fullname, $contextid) {
        $link = new moodle_url('/blocks/qrcode/download.php',
            array('url' => $url,
                'courseid' => $courseid,
                'fullname' => $fullname,
                'download' => false,
                'format' => 0,
                'size' => 100,
                'contextid' => $contextid));

        return html_writer::img($link, get_string('img_tag_alt', 'block_qrcode'), array('id'  => 'img_qrcode'));
    }

    /**
     * Displays download section (menus for choosing format & size, download button).
     * @param $url target url of the QR code
     * @param $courseid CourseID
     * @param $fullname full course name
     * @return string html-string
     */
    public function display_download_section($url, $courseid, $fullname, $contextid) {
        $download = new moodle_url('/blocks/qrcode/download.php',
            array('url' => $url,
                'courseid' => $courseid,
                'fullname' => $fullname,
                'download' => true,
                'contextid' => $contextid
            ));
        $mform = new qrcode_form($download, array('format' => 'png', 'size' => '100px'));

        return $mform->render();
    }

}