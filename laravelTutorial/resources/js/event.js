document.addEventListener('DOMContentLoaded', function () {
    const videoFrame = document.getElementById('videoFrame');

    $('#videoModal').on('show.bs.modal', function (e) {
        const button = $(e.relatedTarget);
        const videoUrl = button.data('video-url');
        if (videoUrl) {
            videoFrame.src = videoUrl.replace('watch?v=', 'embed/');
        }
    });

    videoModal.addEventListener('hidden.bs.modal', function () {
        videoFrame.src = '';
    });
});
