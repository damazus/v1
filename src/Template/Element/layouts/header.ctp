<!DOCTYPE html>
<html ng-app>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->config('Site.name') ?> // <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css([
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css',
        'https://highlightjs.org/static/styles/monokai_sublime.css',
        //'https://highlightjs.org/static/styles/color-brewer.css',
        'src.min.css',
        'style.css'
    ]); ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body style="<?php ""// h($this->request->session()->read('SiteWeb.background_body')) ?>">
    <?= $this->element('layouts/menu'); ?>
    <?= ""// $this->element('layouts/menu', [], ['cache' => ['config' => 'menu']]); ?>
    <?= $this->element('layouts/sidebar'); ?>

    <?= ""//$this->element('layouts/sidebar', [], ['cache' => ['config' => 'sidebar']]); ?>
