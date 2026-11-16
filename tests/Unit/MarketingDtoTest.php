<?php
declare(strict_types=1);
namespace Ksfraser\FrontAccounting\CRM\Marketing\Tests\Unit;
use PHPUnit\Framework\TestCase;
use Ksfraser\FrontAccounting\CRM\Marketing\DTO\MarketingDTO;
class MarketingDtoTest extends TestCase
{
    public function testDtoRoundTripsThroughArray(): void {
        $dto = new MarketingDTO(5, 'Summer Sale', 'email', '2026-07-01', '2026-07-31', '5000.00', '10000', 'active');
        $arr = $dto->toArray();
        $this->assertSame(5, $arr['campaign_id']);
        $this->assertSame('Summer Sale', $arr['name']);
        $this->assertSame('email', $arr['channel']);
        $this->assertSame('2026-07-01', $arr['start_date']);
        $this->assertSame('5000.00', $arr['budget']);
        $this->assertSame('active', $arr['status']);
        $dto2 = MarketingDTO::fromArray($arr);
        $this->assertSame($dto->campaign_id, $dto2->campaign_id);
        $this->assertSame($dto->name, $dto2->name);
        $this->assertSame($dto->status, $dto2->status);
    }
    public function testDisplayLabelUsesNameAndChannelWhenSet(): void {
        $dto = new MarketingDTO(1, 'Summer Sale', 'email');
        $this->assertStringContainsString('Summer Sale', $dto->getDisplayLabel());
        $this->assertStringContainsString('email', $dto->getDisplayLabel());
    }
    public function testDisplayLabelFallsBackToId(): void {
        $dto = new MarketingDTO(9, '', '', '', '', '0.00', '', 'planned');
        $this->assertStringContainsString('Marketing Campaign #9', $dto->getDisplayLabel());
    }
}
