<?php

namespace App\OpenApi;

use ApiPlatform\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\OpenApi\OpenApi;
use ApiPlatform\OpenApi\Model\Server;

final class OpenApiFactory implements OpenApiFactoryInterface
{
    private OpenApiFactoryInterface $decorated;

    public function __construct(OpenApiFactoryInterface $decorated)
    {
        $this->decorated = $decorated;
    }

    /**
     * @param array<string, mixed> $context The context options passed to the factory.
     */
    public function __invoke(array $context = []): OpenApi
    {
        $openApi = ($this->decorated)($context);

        $servers = [
            new Server('https://api.your-domain.com', 'Production API Server'),
            new Server('http://localhost:8065', 'Local Development Server'),
        ];
        $openApi = $openApi->withServers($servers);

        $components = $openApi->getComponents();
        $securitySchemes = $components->getSecuritySchemes() ?? new \ArrayObject();

        $securitySchemes['Bearer'] = new \ArrayObject([
            'type' => 'http',
            'scheme' => 'bearer',
            'bearerFormat' => 'JWT',
            'description' => 'Enter the JWT token obtained by POSTing credentials to the `/login` endpoint. The value must start with the keyword **Bearer** (e.g., `Bearer tcp_f1a09f267b...`).',
        ]);

        $components->getSecuritySchemes()['Bearer'] = $securitySchemes['Bearer'];

        $openApi = $openApi->withSecurity([['Bearer' => []]]);

        if (!$openApi->getPaths()->getPath('/login')) {
            $openApi->getPaths()->addPath('/login', new \ApiPlatform\OpenApi\Model\PathItem(
                post: new \ApiPlatform\OpenApi\Model\Operation(
                    operationId: 'postCredentialsItem',
                    tags: ['Auth'],
                    responses: [
                        '200' => [
                            'description' => 'Successful authentication returning a custom token object.',
                            'content' => new \ArrayObject([
                                'application/json' => [
                                    'schema' => [
                                        'type' => 'object',
                                        'properties' => [
                                            'user' => ['type' => 'string', 'example' => 'test@user.email'],
                                            'tokens' => [
                                                'type' => 'array',
                                                'description' => 'Array of generated tokens.',
                                                'items' => [
                                                    'type' => 'object',
                                                    'properties' => [
                                                        'id' => ['type' => 'integer', 'example' => 1],
                                                        'token' => ['type' => 'string', 'example' => 'tcp_f1a09f267b7d35f827c744f722ed8edccefc3823bec3a2de9288d29103aeb4f0'],
                                                        'expiresAt' => ['type' => 'string', 'format' => 'date-time', 'example' => '2025-11-17T09:44:06+00:00'],
                                                        'scopes' => [
                                                            'type' => 'array',
                                                            'items' => ['type' => 'string', 'example' => 'ROLE_TASK_CREATE'],
                                                        ],
                                                        'ownedBy' => [
                                                            'type' => 'object',
                                                            'description' => 'User details associated with the token (Tasks array is large and omitted).',
                                                            'properties' => [
                                                                'email' => ['type' => 'string', 'example' => 'test@user.email'],
                                                            ]
                                                        ]
                                                    ]
                                                ]
                                            ]
                                        ],
                                    ],
                                ],
                            ]),
                        ],
                        '401' => [
                            'description' => 'Invalid Credentials',
                        ],
                    ],
                    summary: 'Get Custom Token Object (Required for Bearer Auth)',
                    requestBody: new \ApiPlatform\OpenApi\Model\RequestBody(
                        description: 'Provide your email and password for authentication',
                        content: new \ArrayObject([
                            'application/json' => [
                                'schema' => [
                                    'type' => 'object',
                                    'properties' => [
                                        'email' => ['type' => 'string', 'example' => 'test@user.email'],
                                        'password' => ['type' => 'string', 'example' => '123'],
                                    ],
                                ],
                            ],
                        ])
                    )
                )
            ));
        }

        return $openApi;
    }
}
