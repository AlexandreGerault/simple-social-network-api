<?php

namespace Domain\Tests\Users;

use Assert\AssertionFailedException;
use Domain\SSN\Auth\Entity\User;
use Domain\SSN\Auth\Gateway\UserGateway;
use Domain\SSN\Users\UseCases\SearchUser\SearchUser;
use Domain\SSN\Users\UseCases\SearchUser\SearchUserPresenterInterface;
use Domain\SSN\Users\UseCases\SearchUser\SearchUserRequest;
use Domain\SSN\Users\UseCases\SearchUser\SearchUserResponse;
use Domain\Tests\Adapters\Repositories\UserRepository;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class SearchUserTest extends TestCase
{
    private UserGateway $userGateway;
    private SearchUserPresenterInterface $presenter;
    private SearchUser $useCase;

    public function setUp(): void
    {
        parent::setUp();

        $this->userGateway = new UserRepository();
        $this->userGateway->registers(new User(
            Uuid::uuid4(),
            "SwithFR",
            "swith@dev.fr",
            "password"
        ));
        $this->userGateway->registers(new User(
            Uuid::uuid4(),
            "Grafikart",
            "johnatan.boyer@grafikart.fr",
            "password"
        ));
        $this->userGateway->registers(new User(
            Uuid::uuid4(),
            "J0sEf",
            "joseph@dev.fr",
            "password"
        ));
        $this->userGateway->registers(new User(
            Uuid::uuid4(),
            "Demacia",
            "email@dev.fr",
            "password"
        ));

        $this->presenter = new class implements SearchUserPresenterInterface {
            public SearchUserResponse $response;

            public function presents(SearchUserResponse $response): void
            {
                $this->response = $response;
            }
        };

        $this->useCase = new SearchUser($this->userGateway);
    }

    public function testCountGrafikartOnce()
    {
        // Test initialization
        $searchRequest = new SearchUserRequest("grafikart");

        // Test actions
        $this->useCase->execute($searchRequest, $this->presenter);

        // Test assertions
        $this->assertCount(1, $this->presenter->response->getResults());
    }

    public function testCountDevFrThreeTimes()
    {
        // Test initialization
        $searchRequest = new SearchUserRequest("dev.fr");

        // Test actions
        $this->useCase->execute($searchRequest, $this->presenter);

        // Test assertions
        $this->assertCount(3, $this->presenter->response->getResults());
    }

    public function testFailsWithBlankSearch()
    {
        // Test initialization
        $this->expectException(AssertionFailedException::class);
        $searchRequest = new SearchUserRequest("");

        // Test actions
        $this->useCase->execute($searchRequest, $this->presenter);
    }
}
