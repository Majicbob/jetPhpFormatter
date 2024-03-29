<?php
/**
 * Token class unit tests
 *
 * @package  Tests
 * @author   John Tribolet <john@tribolet.info>
 * @filesource
 */

use jet\Formatter\Token as Token;

class TokenClassTest extends PHPUnit_Framework_TestCase
{
    public function testAutoloaderWorks()
    {
        $t = new Token(null);
    }

    public function testConstructWithItemFromGetAllMethod()
    {
        $tokens = token_get_all("<?php echo 'bob'; ?>");
        $t = new Token($tokens[0]);
        $this->assertTrue(!empty($t->name));
        $this->assertEquals('T_OPEN_TAG', $t->name);
    }

    public function testBracesAreBeingHandledCorrectly()
    {
        $rawTokens = token_get_all('<?php function bob() { }');
        $token = new Token($rawTokens[7]); // {
        $this->assertEquals('{', $token->value);
    }
}
