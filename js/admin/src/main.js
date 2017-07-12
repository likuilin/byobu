import User from "flarum/core/models/User";
import addPrivateDiscussionPermission from "flagrow/byobu/addPrivateDiscussionPermission";
import addChatPermission from "flagrow/byobu/addChatPermission";

app.initializers.add('flagrow-byobu', app => {
    app.store.models.recipients = User;
    addPrivateDiscussionPermission();
    addChatPermission();
});
