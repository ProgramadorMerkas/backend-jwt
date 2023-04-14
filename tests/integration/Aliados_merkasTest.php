<?php

declare(strict_types=1);

namespace Tests\integration;

use Fig\Http\Message\StatusCodeInterface;

class Aliados_merkasTest extends TestCase
{
    private static $id;

    public function testCreate(): void
    {
        $params = [
            '' => '',
            'aliado_merkas_id' => 1,
            'usuario_id' => 1
        ];
        $req = $this->createRequest('POST', '/aliados_merkas');
        $request = $req->withParsedBody($params);
        $response = $this->getAppInstance()->handle($request);

        $result = (string) $response->getBody();

        self::$id = json_decode($result)->id;

        $this->assertEquals(StatusCodeInterface::STATUS_CREATED, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetAll(): void
    {
        $request = $this->createRequest('GET', '/aliados_merkas');
        $response = $this->getAppInstance()->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(StatusCodeInterface::STATUS_OK, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetOne(): void
    {
        $request = $this->createRequest('GET', '/aliados_merkas/' . self::$id);
        $response = $this->getAppInstance()->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(StatusCodeInterface::STATUS_OK, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetOneNotFound(): void
    {
        $request = $this->createRequest('GET', '/aliados_merkas/123456789');
        $response = $this->getAppInstance()->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(StatusCodeInterface::STATUS_NOT_FOUND, $response->getStatusCode());
        $this->assertStringContainsString('error', $result);
    }

    public function testUpdate(): void
    {
        $req = $this->createRequest('PUT', '/aliados_merkas/' . self::$id);
        $request = $req->withParsedBody(['' => '']);
        $response = $this->getAppInstance()->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(StatusCodeInterface::STATUS_OK, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testDelete(): void
    {
        $request = $this->createRequest('DELETE', '/aliados_merkas/' . self::$id);
        $response = $this->getAppInstance()->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(StatusCodeInterface::STATUS_NO_CONTENT, $response->getStatusCode());
        $this->assertStringNotContainsString('error', $result);
    }
}
