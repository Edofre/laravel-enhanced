<?php

/**
 * Flash a message to the user and include the level of the message
 * @param        $message
 * @param string $level
 */
function flash($message, $level = 'info')
{
    session()->flash('flash_message', $message);
    session()->flash('flash_message_level', $level);
}

/**
 * Returns the contents of an SVG file, this way we can properly style it using CSS
 * @param $icon_name
 * @return string
 */
function get_svg($icon_name)
{
    // Check if file exists, otherwise return the close icon
    if (!file_exists("assets/images/$icon_name.svg")) {
        $icon_name = 'icon-close';
    }
    return file_get_contents("assets/images/$icon_name.svg");
}