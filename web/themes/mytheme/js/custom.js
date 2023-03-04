(function ($, Drupal, drupalSettings) {

    let btn = document.createElement("button");
    btn.innerHTML = "Alert con el nombre del portal";
    btn.onclick = function () {
        alert(drupalSettings.challengemb.sitename);
      };
    document.body.appendChild(btn);

})(jQuery, Drupal, drupalSettings);