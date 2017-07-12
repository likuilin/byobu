import {extend} from 'flarum/extend';
import IndexPage from 'flarum/components/IndexPage';
import Button from 'flarum/components/Button';
import ChatModal from 'flagrow/byobu/components/ChatModal';

export default function () {
    let chat = new ChatModal;

    extend(IndexPage.prototype, 'sidebarItems', function (items) {
        if (app.session.user) {
            items.add('chat', Button.component({
                children: app.translator.trans('flagrow-byobu.forum.buttons.chat'),
                className: 'Button Button--primary Button--block IndexPage-chat',
                itemClassName: 'App-primaryControl',
                icon: 'commenting-o',
                onclick: () => app.modal.show(chat)
            }), 5)
        }

        return items
    });
}
