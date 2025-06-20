/******/ (() => { // webpackBootstrap
/*!*******************************!*\
  !*** ./resources/js/event.js ***!
  \*******************************/
document.addEventListener('DOMContentLoaded', function () {
  var videoFrame = document.getElementById('videoFrame');
  $('#videoModal').on('show.bs.modal', function (e) {
    var button = $(e.relatedTarget);
    var videoUrl = button.data('video-url');
    if (videoUrl) {
      videoFrame.src = videoUrl.replace('watch?v=', 'embed/');
    }
  });
  videoModal.addEventListener('hidden.bs.modal', function () {
    videoFrame.src = '';
  });
});
/******/ })()
;