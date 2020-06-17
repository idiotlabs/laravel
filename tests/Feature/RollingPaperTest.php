<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('post', function () {
    $data = [
        'receiver' => faker()->name,
        'text' => faker()->text,
    ];

    $response = $this->post('/api/rollingpaper/wirte', $data);

    assertEquals(200, $response->getStatusCode());
    $this->assertDatabaseHas('rolling_paper', ['receiver' => $data['receiver'], 'note' => $data['text']]);
});