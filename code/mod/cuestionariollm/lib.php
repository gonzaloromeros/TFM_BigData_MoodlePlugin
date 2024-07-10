<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Library of interface functions and constants.
 *
 * @package     mod_cuestionariollm
 * @copyright   2024 Gonzalo Romero <gonzalo.romeros@alumnos.upm.es>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Return if the plugin supports $feature.
 *
 * @param string $feature Constant representing the feature.
 * @return true | null True if the feature is supported, null otherwise.
 */
function cuestionariollm_supports($feature) {
    switch ($feature) {
        case FEATURE_MOD_INTRO:
            return true;
        default:
            return null;
    }
}

/**
 * Saves a new instance of the mod_cuestionariollm into the database.
 *
 * Given an object containing all the necessary data, (defined by the form
 * in mod_form.php) this function will create a new instance and return the id
 * number of the instance.
 *
 * @param object $moduleinstance An object from the form.
 * @param mod_cuestionariollm_mod_form $mform The form.
 * @return int The id of the newly inserted record.
 */
function cuestionariollm_add_instance($moduleinstance, $mform = null) {
    global $DB;

    $moduleinstance->timecreated = time();

    $id = $DB->insert_record('cuestionariollm', $moduleinstance);

    return $id;
}

/**
 * Updates an instance of the mod_cuestionariollm in the database.
 *
 * Given an object containing all the necessary data (defined in mod_form.php),
 * this function will update an existing instance with new data.
 *
 * @param object $moduleinstance An object from the form in mod_form.php.
 * @param mod_cuestionariollm_mod_form $mform The form.
 * @return bool True if successful, false otherwise.
 */
function cuestionariollm_update_instance($moduleinstance, $mform = null) {
    global $DB;

    $moduleinstance->timemodified = time();
    $moduleinstance->id = $moduleinstance->instance;

    return $DB->update_record('cuestionariollm', $moduleinstance);
}

/**
 * Removes an instance of the mod_cuestionariollm from the database.
 *
 * @param int $id Id of the module instance.
 * @return bool True if successful, false on failure.
 */
function cuestionariollm_delete_instance($id) {
    global $DB;

    $exists = $DB->get_record('cuestionariollm', array('id' => $id));
    if (!$exists) {
        return false;
    }

    $DB->delete_records('cuestionariollm', array('id' => $id));

    return true;
}

/**
 * Returns the lists of all browsable file areas within the given module context.
 *
 * The file area 'intro' for the activity introduction field is added automatically
 * by {@see file_browser::get_file_info_context_module()}.
 *
 * @package     mod_cuestionariollm
 * @category    files
 *
 * @param stdClass $course
 * @param stdClass $cm
 * @param stdClass $context
 * @return string[].
 */
function cuestionariollm_get_file_areas($course, $cm, $context) {
    return array();
}

/**
 * File browsing support for mod_cuestionariollm file areas.
 *
 * @package     mod_cuestionariollm
 * @category    files
 *
 * @param file_browser $browser
 * @param array $areas
 * @param stdClass $course
 * @param stdClass $cm
 * @param stdClass $context
 * @param string $filearea
 * @param int $itemid
 * @param string $filepath
 * @param string $filename
 * @return file_info Instance or null if not found.
 */
function cuestionariollm_get_file_info($browser, $areas, $course, $cm, $context, $filearea, $itemid, $filepath, $filename) {
    return null;
}

/**
 * Serves the files from the mod_cuestionariollm file areas.
 *
 * @package     mod_cuestionariollm
 * @category    files
 *
 * @param stdClass $course The course object.
 * @param stdClass $cm The course module object.
 * @param stdClass $context The mod_cuestionariollm's context.
 * @param string $filearea The name of the file area.
 * @param array $args Extra arguments (itemid, path).
 * @param bool $forcedownload Whether or not force download.
 * @param array $options Additional options affecting the file serving.
 */
function cuestionariollm_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, $options = array()) {
    global $DB, $CFG;

    if ($context->contextlevel != CONTEXT_MODULE) {
        send_file_not_found();
    }

    require_login($course, true, $cm);
    send_file_not_found();
}

/**
 * Extends the global navigation tree by adding mod_cuestionariollm nodes if there is a relevant content.
 *
 * This can be called by an AJAX request so do not rely on $PAGE as it might not be set up properly.
 *
 * @param navigation_node $cuestionariollmnode An object representing the navigation tree node.
 * @param stdClass $course
 * @param stdClass $module
 * @param cm_info $cm
 */
function cuestionariollm_extend_navigation($cuestionariollmnode, $course, $module, $cm) {
}

/**
 * Extends the settings navigation with the mod_cuestionariollm settings.
 *
 * This function is called when the context for the page is a mod_cuestionariollm module.
 * This is not called by AJAX so it is safe to rely on the $PAGE.
 *
 * @param settings_navigation $settingsnav {@see settings_navigation}
 * @param navigation_node $cuestionariollmnode {@see navigation_node}
 */
function cuestionariollm_extend_settings_navigation($settingsnav, $cuestionariollmnode = null) {
}
