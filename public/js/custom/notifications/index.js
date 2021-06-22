function deleteNotification (id) {
    if (window.confirm(`Delete this notification?`)) {
        jQuery.ajax({
            url: getBaseURL() + 'notifications/' + id,
            dataType: "JSON",
            type: "POST",
            data: {
                '_method': 'DELETE'
            },
            beforeSend: function () {
            },
            success: function () {
                location.reload();
            },
            error: HandleJsonErrors,
        });
    }
}

function deleteAllNotification () {
    if (window.confirm('Clear all notifications?')) {
        jQuery.ajax({
            url: getBaseURL() + 'notifications/delete_all',
            dataType: "JSON",
            type: "POST",
            data: {
                '_method': 'DELETE'
            },
            beforeSend: function () {
            },
            success: function () {
                location.reload();
            },
            error: HandleJsonErrors,
        });
    }
}
