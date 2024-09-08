<?php

/**
 * Create
 */
function alert_msg($text, $type = "danger")
{
    return "<p class=\"alert alert-{$type} d-flex justify-content-between\">{$text}<button class=\"btn-close\" data-bs-dismiss=\"alert\"></button></p>";
};


/**
 *value submit from form
 */
function old($field_name)
{
    return $_POST[$field_name] ?? "";
};


/**
 * Reset form data
 */
function reset_form()
{
    return $_POST = [];
}
