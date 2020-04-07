<?php
namespace CONTROLLERS;
final class Mock
{
    public static function handle()
    {
        return view('errors/ControllerNotFound');
    }
}