<div class="da-toolbar-block da-toolbar-block-left">
  <span class="da-toolbar-value">
    <i class="fa fa-microchip"></i>
    {$collector->getMemory()|string_format:"%.1f"} MB
  </span>
  <div class="da-toolbar-details">
    <table>
      <tr>
        <td>Peak memory usage</td>
        <td>{$collector->getMemory()|string_format:"%.1f"} MB</td>
      </tr>
      <tr>
        <td>PHP memory limit</td>
        <td>{$collector->getMemoryLimit()|string_format:"%.1f"} MB</td>
      </tr>
    </table>
  </div>
</div>
