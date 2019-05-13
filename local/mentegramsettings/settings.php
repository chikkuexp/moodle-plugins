<?php
// This file is part of the Local welcome plugin
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
 * This plugin sends users a welcome message after logging in
 * and notify a moderator a new user has been added
 * it has a settings page that allow you to configure the messages
 * send.
 *
 * @package    local
 * @subpackage mentorcodeofconductform
 * @Author     Ranganathan
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) {

    $moderator = get_admin();
    $site = get_site();

    $settings = new admin_settingpage('local_mentegramsettings', get_string('pluginname', 'local_mentegramsettings'));
    $ADMIN->add('localplugins', $settings);

    $name = 'local_mentegramsettings/mentegramclientid';
    $title = get_string('mentegramclientid', 'local_mentegramsettings');
    $description = get_string('mentegramclientid_desc', 'local_mentegramsettings');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $settings->add($setting); 

    $name = 'local_mentegramsettings/mentegramclientsecret';
    $title = get_string('mentegramclientsecret', 'local_mentegramsettings');
    $description = get_string('mentegramclientsecret_desc', 'local_mentegramsettings');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $settings->add($setting);

    $name = 'local_mentegramsettings/mentegramtherapistusername';
    $title = get_string('mentegramtherapistusername', 'local_mentegramsettings');
    $description = get_string('mentegramtherapistusername_desc', 'local_mentegramsettings');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $settings->add($setting);

    $name = 'local_mentegramsettings/mentegramtherapistpassword';
    $title = get_string('mentegramtherapistpassword', 'local_mentegramsettings');
    $description = get_string('mentegramtherapistpassword_desc', 'local_mentegramsettings');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $settings->add($setting);

    $name = 'local_mentegramsettings/mentegramorganizationid';
    $title = get_string('mentegramorganizationid', 'local_mentegramsettings');
    $description = get_string('mentegramorganizationid_desc', 'local_mentegramsettings');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $settings->add($setting);
}