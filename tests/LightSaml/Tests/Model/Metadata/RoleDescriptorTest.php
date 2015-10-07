<?php

namespace LightSaml\Tests\Model\Metadata;

use LightSaml\Model\XmlDSig\SignatureWriter;
use LightSaml\Tests\Fixtures\Model\Metadata\RoleDescriptorMock;

class RoleDescriptorTest extends \PHPUnit_Framework_TestCase
{
    public function test_set_valid_cache_duration()
    {
        $rd = new RoleDescriptorMock();
        $rd->setCacheDuration($expectedValue = 'P1Y');
        $this->assertEquals($expectedValue, $rd->getCacheDuration());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function test_set_invalid_cache_duration()
    {
        $rd = new RoleDescriptorMock();
        $rd->setCacheDuration('123');
    }

    public function test_set_error_url()
    {
        $rd = new RoleDescriptorMock();
        $rd->setErrorURL($expectedValue = 'http://example.com/error');
        $this->assertEquals($expectedValue, $rd->getErrorURL());
    }

    public function test_set_id()
    {
        $rd = new RoleDescriptorMock();
        $rd->setID($expectedValue = 'id-123');
        $this->assertEquals($expectedValue, $rd->getID());
    }

    public function test_get_first_key_descriptor_returns_null_when_empty()
    {
        $rd = new RoleDescriptorMock();
        $this->assertNull($rd->getFirstKeyDescriptor());
    }

    public function test_add_signature()
    {
        $rd = new RoleDescriptorMock();
        $rd->addSignature($s1 = new SignatureWriter());
        $rd->addSignature($s2 = new SignatureWriter());
        $this->assertCount(2, $arr = $rd->getAllSignatures());
        $this->assertSame($s1, $arr[0]);
        $this->assertSame($s2, $arr[1]);
    }

    public function test_set_valid_until_string()
    {
        $rd = new RoleDescriptorMock();
        $rd->setValidUntil('2013-10-27T11:55:37Z');
        $this->assertEquals(1382874937, $rd->getValidUntilTimestamp());
    }

    public function test_set_valid_until_timestamp()
    {
        $rd = new RoleDescriptorMock();
        $rd->setValidUntil($expectedValue = 1382874937);
        $this->assertEquals(1382874937, $rd->getValidUntilTimestamp());
    }

    public function test_set_valid_until_date_time()
    {
        $rd = new RoleDescriptorMock();
        $rd->setValidUntil(new \DateTime('2013-10-27T11:55:37Z'));
        $this->assertEquals(1382874937, $rd->getValidUntilTimestamp());
    }

    public function test_get_valid_until_string()
    {
        $rd = new RoleDescriptorMock();
        $rd->setValidUntil($expectedValue = '2013-10-27T11:55:37Z');
        $this->assertEquals('2013-10-27T11:55:37Z', $rd->getValidUntilString());
    }
}
