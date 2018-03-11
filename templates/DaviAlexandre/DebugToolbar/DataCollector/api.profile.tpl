<h3>API Statistics</h3>
<div class="da-profile-stats">
  <div class="da-profile-stat">
    <div class="da-profile-stat-value">
      {$collector->getNumberOfApiCalls()}
    </div>
    <div class="da-profile-stat-name">
      No. of API calls
    </div>
  </div>
  <div class="da-profile-stat">
    <div class="da-profile-stat-value">
      {$collector->getTotalTime()|string_format:"%.2f"} ms
    </div>
    <div class="da-profile-stat-name">
      Total Time
    </div>
  </div>
  <div class="da-profile-stat">
    <div class="da-profile-stat-value">
      {$collector->getAverageCallTime()|string_format:"%.2f"} ms
    </div>
    <div class="da-profile-stat-name">
      Average call time
    </div>
  </div>
</div>

<h3>API Calls</h3>
<table>
  <thead>
    <tr>
      <th>#</th>
      <th>API</th>
      <th>Count</th>
      <th>Time</th>
    </tr>
  </thead>
  <tbody>
    {foreach from=$collector->getApiCalls() item=apiCall name=apiCalls}
      <tr>
        <td>{$smarty.foreach.apiCalls.iteration}</td>
        <td>{$apiCall.entity}.{$apiCall.action}</td>
        <td>{$apiCall.response.count}</td>
        <td>{$apiCall.time|string_format:"%.2f"} ms</td>
      </tr>
    {/foreach}
  </tbody>
</table>
