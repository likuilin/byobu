import Modal from "flarum/components/Modal";
import ChatInput from "flagrow/byobu/components/chat/ChatInput";

export default class ChatModal extends Modal {


    /**
     * Get the title of the modal dialog.
     *
     * @return {String}
     * @abstract
     */
    title() {
        return app.translator.trans('flagrow-byobu.forum.buttons.chat');
    }

    /**
     * Get the content of the modal.
     *
     * @return {VirtualElement}
     * @abstract
     */
    content() {
        return m('div', [
            ChatInput.component()
        ])
    }

    /**
     * Handle the modal form's submit event.
     *
     * @param {Event} e
     */
    onsubmit() {
    }

    /**
     * Get the class name to apply to the modal.
     *
     * @return {String}
     * @abstract
     */
    className() {
        return 'Modal--large';
    }
}
