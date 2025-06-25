<?php declare(strict_types=1);
/**
 * @author Jacques Marneweck <jacques@siberia.co.za>
 */

namespace Jacques\Eloquent\Helpers;

final class Metrics
{
    /**
     * Builds a SQL query string for daily aggregation.
     * 
     * The returned string contains multiple SUM(IF()) expressions that count
     * trips on each day of the month for use in a larger query.
     * 
     * @param array $days Array of day information from Period::getDays()
     * @return string The SQL query fragment
     */
    private function buildDailyQueryString(array $days): string
    {
        $parts = [];
        foreach ($days as $day) {
            $parts[] = 'SUM(IF(date = \'' . $day['date'] . '\', 1, 0)) ' . $day['alias'];
        }
        
        return implode(', ', $parts);
    }
}
