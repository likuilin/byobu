import {extend} from "flarum/extend";
import PermissionGrid from "flarum/components/PermissionGrid";

export default function () {
    extend(PermissionGrid.prototype, 'startItems', items => {
        items.add('startChat', {
            icon: 'commenting-o',
            label: app.translator.trans('flagrow-byobu.admin.permission.chat'),
            permission: 'startChat'
        }, 95);
    });
}
