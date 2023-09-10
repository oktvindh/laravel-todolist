<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    public function testTodolist()
    {
        $this->withSession([
            "user" => "indah",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "indah"
                ],
                [
                    "id" => "2",
                    "todo" => "oktaviana"
                ]
            ]
        ])->get('/todolist')
            ->assertSeeText("1")
            ->assertSeeText("indah")
            ->assertSeeText("2")
            ->assertSeeText("oktaviana");
    }

    public function testAddTodoFailed()
    {
        $this->withSession([
            "user" => "oktaviana"
        ])->post("/todolist", [])
            ->assertSeeText("Todo is required");
    }

    public function testAddTodoSuccess()
    {
        $this->withSession([
            "user" => "indah"
        ])->post("/todolist", [
            "todo" => "oktaviana"
        ])->assertRedirect("/todolist");
    }

    public function testRemoveTodolist()
    {
        $this->withSession([
            "user" => "indah",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "indah"
                ],
                [
                    "id" => "2",
                    "todo" => "oktaviana"
                ]
            ]
        ])->post("/todolist/1/delete")
            ->assertRedirect("/todolist");
    }


}
