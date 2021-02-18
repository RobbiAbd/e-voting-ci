/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

function getCsrf() {
  return $("meta[name='_csrf'").attr("content");
}

function setCsrf(csrf) {
  $('input[name="_csrf"]').val(csrf);
  $("meta[name='_csrf'").attr("content", csrf);
}
