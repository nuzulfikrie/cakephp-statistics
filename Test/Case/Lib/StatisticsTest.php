<?php
App::uses('Statistics', 'Statistics.Lib');

/**
 * Statistics Test Case
 *
 */
class StatisticsTest extends CakeTestCase {

	public function testSum() {
		//
		// Integers
		//

		$values = [1, 2, 3, 4, 4];

		$result = Statistics::sum($values);
		$expected = 14;

		$this->assertIdentical($expected, $result);

		//
		// Floats
		//

		$values = [-1.0, 2.5, 3.25, 5.75];

		$result = Statistics::sum($values);
		$expected = 10.5;

		$this->assertIdentical($expected, $result);

		//
		// Mixed
		//

		$values = [-2, 2.5, 3.25, 5.75, 0];

		$result = Statistics::sum($values);
		$expected = 9.5;

		$this->assertIdentical($expected, $result);
	}

	public function testMin() {
		//
		// Integers
		//

		$values = [1, 2, 3, 4, 4];

		$result = Statistics::min($values);
		$expected = 1;

		$this->assertIdentical($expected, $result);

		//
		// Floats
		//

		$values = [-1.0, 2.5, 3.25, 5.75];

		$result = Statistics::min($values);
		$expected = -1.0;

		$this->assertIdentical($expected, $result);
	}

	public function testMax() {
		//
		// Integers
		//

		$values = [1, 2, 3, 4, 4];

		$result = Statistics::max($values);
		$expected = 4;

		$this->assertIdentical($expected, $result);

		//
		// Floats
		//

		$values = [-1.0, 2.5, 3.25, 5.75];

		$result = Statistics::max($values);
		$expected = 5.75;

		$this->assertIdentical($expected, $result);
	}

	public function testMean() {
		//
		// Integers
		//

		$values = [1, 2, 3, 4, 4];

		$result = Statistics::mean($values);
		$expected = 2.8;

		$this->assertIdentical($expected, $result);

		//
		// Floats
		//

		$values = [-1.0, 2.5, 3.25, 5.75];

		$result = Statistics::mean($values);
		$expected = 2.625;

		$this->assertIdentical($expected, $result);

		//
		// Mixed
		//

		$values = [-2, 2.5, 3.25, 5.75, 0];

		$result = Statistics::mean($values);
		$expected = 1.9;

		$this->assertIdentical($expected, $result);
	}

	public function testFrequency() {
		//
		// Integers
		//

		$values = [1, 1, 2, 3, 3, 3, 3, 4];

		$result = Statistics::frequency($values);
		$expected = [
			4 => 1,
			2 => 1,
			1 => 2,
			3 => 4,
		];

		$this->assertIdentical($expected, $result);

		//
		// Floats
		//

		$values = [1, 3, 6, 6, 6, 6, 7.12, 7.12, 12, 12, 17];

		$result = Statistics::frequency($values);
		$expected = [
			17 => 1,
			1 => 1,
			3 => 1,
			12 => 2,
			'7.12' => 2,
			6 => 4,
		];

		$this->assertIdentical($expected, $result);

		//
		// Strings
		//

		$values = ['red', 'blue', 'blue', 'red', 'green', 'red', 'red'];

		$result = Statistics::frequency($values);
		$expected = [
			'green' => 1,
			'blue' => 2,
			'red' => 4,
		];

		$this->assertIdentical($expected, $result);
	}

	public function testMode() {
		//
		// Integers
		//

		$values = [3];

		$result = Statistics::mode($values);
		$expected = 3;

		$this->assertIdentical($expected, $result);

		$values = [1, 1, 2, 3, 3, 3, 3, 4];

		$result = Statistics::mode($values);
		$expected = 3;

		$this->assertIdentical($expected, $result);

		$values = [1, 3, 6, 6, 6, 6, 7, 7, 12, 12, 17];

		$result = Statistics::mode($values);
		$expected = 6;

		$this->assertIdentical($expected, $result);

		//
		// Strings
		//

		$values = ['red', 'blue', 'blue', 'red', 'green', 'red', 'red'];

		$result = Statistics::mode($values);
		$expected = 'red';

		$this->assertIdentical($expected, $result);
	}

/**
 * @expectedException StatisticsError
 */
	public function testModeNotExactlyOne() {
		$values = [1, 1, 2, 4, 4];

		$result = Statistics::mode($values);
	}

	public function testVariance() {
		//
		// Sample (default)
		//

		//
		// Integers
		//
		$values = [2, 4, 4, 4, 5, 5, 7, 9];
		$sample = true;

		$result = Statistics::variance($values, $sample);
		$expected = 4.571429;

		$this->assertEquals($expected, $result, '', pow(10, -4));

		//
		// Floats
		//

		$values = [0.0, 0.25, 0.25, 1.25, 1.5, 1.75, 2.75, 3.25];
		$sample = true;

		$result = Statistics::variance($values, $sample);
		$expected = 1.428571;

		$this->assertEquals($expected, $result, '', pow(10, -4));

		//
		// Population
		//

		//
		// Integers
		//
		$values = [2, 4, 4, 4, 5, 5, 7, 9];
		$sample = false;

		$result = Statistics::variance($values, $sample);
		$expected = 4;

		$this->assertIdentical($expected, $result);

		//
		// Floats
		//

		$values = [0.0, 0.25, 0.25, 1.25, 1.5, 1.75, 2.75, 3.25];
		$sample = false;

		$result = Statistics::variance($values, $sample);
		$expected = 1.25;

		$this->assertIdentical($expected, $result, '', pow(10, -4));
	}

	public function testStandardDeviation() {
		//
		// Sample (default)
		//

		//
		// Integers
		//
		$values = [2, 4, 4, 4, 5, 5, 7, 9];
		$sample = true;

		$result = Statistics::standardDeviation($values, $sample);
		$expected = 2.13809;

		$this->assertEquals($expected, $result, '', pow(10, -4));

		//
		// Floats
		//

		$values = [1.5, 2.5, 2.5, 2.75, 3.25, 4.75];
		$sample = true;

		$result = Statistics::standardDeviation($values, $sample);
		$expected = 1.081087;

		$this->assertEquals($expected, $result, '', pow(10, -4));

		//
		// Population
		//

		//
		// Integers
		//
		$values = [2, 4, 4, 4, 5, 5, 7, 9];
		$sample = false;

		$result = Statistics::standardDeviation($values, $sample);
		$expected = 2.0;

		$this->assertIdentical($expected, $result);

		//
		// Floats
		//

		$values = [1.5, 2.5, 2.5, 2.75, 3.25, 4.75];
		$sample = false;

		$result = Statistics::standardDeviation($values, $sample);
		$expected = 0.9868;

		$this->assertEquals($expected, $result, '', pow(10, -4));
	}

	public function testRange() {
		//
		// Integers (> 0)
		//
		$values = [4, 6, 10, 15, 18];
		$result = Statistics::range($values);
		$expected = 14;

		$this->assertIdentical($expected, $result);

		//
		// Integers (< 0 and > 0)
		//

		$values = [4, 6, 10, 15, 18, -18];
		$result = Statistics::range($values);
		$expected = 36;

		$this->assertIdentical($expected, $result);

		//
		// Floats
		//
		$values = [11, 13, 4.3, 15.5, 14];
		$result = Statistics::range($values);
		$expected = 11.2;

		$this->assertIdentical($expected, $result);
	}

}
