<?php

declare(strict_types=1);

/**
 * Copyright (C) 2018-present Davide Franco
 *
 * This file is part of Bacula-Web.
 *
 * Bacula-Web is free software: you can redistribute it and/or modify it under the terms of the GNU
 * General Public License as published by the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 *
 * Bacula-Web is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with Bacula-Web. If not, see
 * <https://www.gnu.org/licenses/>.
 */

namespace Core\Utils;

use App\Libs\FileConfig;

class HtmlHelper
{
    /**
    * Return html header
    * @return string
    */
    public static function getHtmlHeader(): string
    {
        return '<!DOCTYPE html>
                        <html lang="en">
                        <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap css -->
    <link rel="stylesheet" href="/css/bootstrap.min.css" integrity="sha256-MBffSnbbXwHCuZtgPYiwMQbfE7z+GOZ7fBPCNB06Z98=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    
    <title>Bacula-Web - Application error</title>

    <!-- FontAwesome css -->
    <link href="./css/all.css" rel="stylesheet">

    <link rel="apple-touch-icon" href="/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/img/favicon.ico">
    </head>

    <body>';
    }

    /**
     * Return Bootstrap navbar
     *
     * @return string
     */
    public static function getNavBar(): string
    {
        return '<nav class="navbar navbar-expand-md navbar-dark bg-dark" aria-label="Fourth navbar example">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="/img/bacula-web-logo.png" alt="Bacula-Web logo" width="22" height="24" class="d-inline-block align-top">
            Bacula-Web
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> </nav></div>';
    }

    /**
    * Return html footer
    * @return string
    */
    public static function getHtmlFooter(): string
    {
        return '<script src="/js/bootstrap.min.js" integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script>
                <script type="text/javascript" src="/js/default.js"></script>
                </body>
                </html>';
    }
}
