# kuilin's branch of byobu

This is a fork of Byobu implementing a few changes for a private instance of Flarum. 

Changes: 

* Makes the search results in "Add recipients to your discussion" always be present, listing all permissions groups (and no users) instead of not being present when the search box is empty. This allows users to more quickly select groups, assuming the number of groups is reasonably small (which it should be). 

![image](https://user-images.githubusercontent.com/16179637/120252642-bbdb1e00-c24a-11eb-86d9-c8dde4a1ed2a.png)

* Makes Private Discussions in the nav sidebar priority 99 instead of 75, so that it sits on top of User Directory with that extension.

# Byōbu by FriendsOfFlarum

[![MIT license](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/FriendsOfFlarum/byobu/blob/master/LICENSE)
[![Latest Stable Version](https://img.shields.io/packagist/v/fof/byobu.svg)](https://packagist.org/packages/fof/byobu)
[![Total Downloads](https://img.shields.io/packagist/dt/fof/byobu.svg)](https://packagist.org/packages/fof/byobu)
[![Donate](https://img.shields.io/badge/opencollective-support-blue.svg)](https://opencollective.com/fof)

Private discussions for your forum. Allows you to select specific recipients for your discussions.

## Goals

- Create discussions only specific users or groups can participate in.
- Force new posts in these private discussions to show real-time.

## Installation


    composer require "fof/byobu:*"

## Updating

    composer update fof/byobu
    php flarum migrate
    php flarum cache:clear

## Configuration

Enable the extension under the extensions tab in the admin area.

Make sure you configure the private discussions permission on the Admin Permissions tab to your needs;

- Create private discussions with users
- Create private discussions with groups
- Create private discussions with blockers
- Edit recipient users of private discussions
- Edit recipient groups of private discussions

## Notifications

Browser alert and email notifications are available for `user` recipients of private discussions for:

- Private discussion started
- Private discussion replied
- User added to private discussion
- User left the private discussion

Notifications for `group` recipients are available for:

- Private discussion started
- Private discussion replied

(More notification types are planned for `groups` soon)

## Support our work

We prefer to keep our work available to everyone.
In order to do so we rely on voluntary contributions on [OpenCollective](https://opencollective.com/fof).

## Links

- [Flarum Discuss post](https://discuss.flarum.org/d/4762)
- [Source code on GitHub](https://github.com/FriendsOfFlarum/byobu)
- [Changelog](https://github.com/FriendsOfFlarum/byobu/blob/master/CHANGELOG.md)
- [Report an issue](https://github.com/FriendsOfFlarum/byobu/issues)
- [Download via Packagist](https://packagist.org/packages/fof/byobu)

An extension by FriendsOfFlarum.
