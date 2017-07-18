function (commit) {
    if (/^dlx\.testing\.article\-/.test(commit._id)) {
        emit([ commit.streamId, commit.streamRevision ], 1);
    }
}