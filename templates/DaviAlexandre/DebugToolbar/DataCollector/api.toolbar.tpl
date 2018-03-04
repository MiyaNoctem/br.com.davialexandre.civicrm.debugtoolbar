<div class="da-toolbar-block da-toolbar-block-left">
  <span class="da-toolbar-value">
    <i class="fa fa-plug"></i>{$collector->getNumberOfApiCalls()} in {$collector->getTotalTime()} ms
  </span>
  <div class="da-toolbar-details">
    <table>
      <tr>
        <td>No. of API calls</td>
        <td>{$collector->getNumberOfApiCalls()}</td>
      </tr>
      <tr>
        <td>Average API call time</td>
        <td>{$collector->getAverageCallTime()|string_format:"%.2f"} ms</td>
      </tr>
    </table>
  </div>
</div>
