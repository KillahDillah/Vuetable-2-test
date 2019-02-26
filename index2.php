<?php

require_once("init.php");
require_once("../system/classes/Adsupplier.php");
// require_once("../system/classes/Template.php");
require_once("../system/classes/App.php");

if (!$_SESSION['nu_id']) {
  header('Location: /index_network.php');
  exit();
}

$agencies = array();
  // Agency list
$agencyList = Adsupplier::getParentAgenciesList();
foreach ($agencyList as $agency) {
    $agencies[] = array('id' => (string)$agency['as_id'], 'name' => html_entity_decode($agency['as_company']));
}

?>
<!-- Vue -->
<script src="//cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
<script src="https://unpkg.com/vuetable-2@1.6.0"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.2.6/vue.min.js"></script>
<!-- Lodash / Moment / Popper -->
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.11/lodash.core.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<!-- Javascript -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.16.1/axios.min.js"></script>
<!-- Javascript -->
<script src="../includes/app.js"></script>
<script src="../includes/app2.js"></script>
<!-- CSS -->
<link href="//fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
<!-- <link rel="stylesheet/less" type="text/css" href="../includes/css/master.less"> -->
<link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css">
<!-- 
<link rel="stylesheet" type="text/css" href="../includes/css/vue.css">
<link rel="stylesheet" type="text/css" href="../includes/css/app.css">
<link rel="stylesheet" type="text/css" href="../includes/css/front.css">
<link rel="stylesheet" type="text/css" href="../system/js/lib.css"> -->
<!-- Vuetable styling -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.7/semantic.min.css" media="screen"
  title="no title" charset="utf-8">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
      crossorigin="anonymous">


<main style="margin:10px;">

  <div id="airingLogBatchesNetworkApp" >
    <!-- Filters -->
    <filter-bar-agency v-model="filterQuery.agencyId" :filter-query="filterQuery" :agency-id="filterQuery.agencyId" :reset-filters='resetFilters' :start-date='filterQuery.startDate' :end-date='filterQuery.endDate' :agency-list='agencyList' :reset-filters='resetFilters' :get-airing-log-batch-list='getAiringLogBatchList'></filter-bar-agency>
    <filter-bar-agency v-model="filterQuery.agencyId" :filter-query="filterQuery" :agency-id="filterQuery.agencyId" :reset-filters='resetFilters' :start-date='filterQuery.startDate' :end-date='filterQuery.endDate' :agency-list='agencyList' :reset-filters='resetFilters' :get-airing-log-batch-list='getAiringLogBatchList'></filter-bar-agency>
    <!-- Log Batch Rows-->
    <div id="main">
      <div class="outside" style="margin-bottom:10px;">
        <header class="title">
          Airing Log Batches
          <span class="toggleShowHide"><em title="Hide section" class="fa fa-minus"></em></span>
        </header>
        <my-airing-logs></my-airing-logs>
        <my-airing-logs></my-airing-logs>
        <div id="top" style="height:270px;">

          <section id="airingLogBatchTables" style="width:100%;" v-if="!shouldHide.airingLogBatches">
            <div class="table-scroll-outer-container">
              <div class="table-scroll-inner-container">
                <!-- Header -->
                <log-batch-rows-header :set-sort-by="setSortBy" :sort-by-batch="sortByBatch" :sort-by-batch-reverse="sortByBatchReverse"></log-batch-rows-header>
                <log-batch-rows-header :set-sort-by="setSortBy" :sort-by-batch="sortByBatch" :sort-by-batch-reverse="sortByBatchReverse"></log-batch-rows-header>
                <!-- Body -->
                <!-- <log-batch-body :get-airing-log-spot-detail='getAiringLogSpotDetail' :handle-scroll="handleScroll" :format-number="formatNumber" :format-filename="formatFilename" :sort-by-batch="sortByBatch" :saving="saving" :decode="decode" :format-date="formatDate" :format-time="formatTime" :is-demo-feature="isDemoFeature" :airing-log-batch-list="airingLogBatchList" :airing-log-batches-sorted="airingLogBatchesSorted"></log-batch-body> -->
                <!-- Footer -->
                <log-batch-footer :display-batch-total-summary="displayBatchTotalSummary"></log-batch-footer>
                <log-batch-footer :display-batch-total-summary="displayBatchTotalSummary"></log-batch-footer>
              </div>
            </div>
          </section>
        </div>
        <div id="handle"></div>

        <!-- Spot Detail -->
        <div class="outside">
          <header class="title">
            Spot Detail for the selected batch
            <span class="toggleShowHide"><em title="Hide section" class="fa fa-minus"></em></span>
          </header>
          <div id="middle" style="height:270px;">
            <section id="spotDetailsTables" v-if="!shouldHide.spotDetail">
              <div class="table-scroll-outer-container">
                <div class="table-scroll-inner-container">
                <my-spot-summary></my-spot-summary>
                  <!-- Header -->
                  <spot-detail-header :sort-by-spot="sortBySpot" :sort-by-spot-reverse="sortBySpotReverse" :set-sort-by="setSortBy"></spot-detail-header>
                  <spot-detail-header :sort-by-spot="sortBySpot" :sort-by-spot-reverse="sortBySpotReverse" :set-sort-by="setSortBy"></spot-detail-header>
                  <!-- Body -->
                  <!-- <spot-body :handle-scroll='handleScroll' :spot-details='spotDetails' :saving-detail='savingDetail' :is-demo-feature='isDemoFeature' :spot-details-sorted='spotDetailsSorted' :decode='decode' :display-status='displayStatus' :format-date='formatDate' :format-time='formatTime' :format-currency='formatCurrency'></spot-body> -->
                </div>
              </div>
            </section>
          </div>
        </div>
        <div id="handle1"></div>
        <!-- Spot Summary -->
          <spot-summary :format-file-name="formatFilename" :should-hide="shouldHide" :saving="saving" :display-total-summary="displayTotalSummary" :decode="decode" :format-number="formatNumber" :client-summary-sorted="clientSummarySorted" :station-summary-sorted="stationSummarySorted"></spot-summary>
      </div>
    </div>
    <!-- Modal: Demo CI display -->
    <div class="modal fade" id="demoCIModal" tabindex="-1" role="dialog" aria-labelledby="demoCILabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <img src="../images/temp-demo-copy-instruction-screen.png?date=20190122" style="width:100%;">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>


<script>
 $(function () {
    // Tooltips
    $('body').click(function() {
      $('._nTip').hide();
    });
  });
  var _NETWORK_USER_ID = '';
  <?php if ($_SESSION['nu_id']) { ?>
    _NETWORK_USER_ID = "<?php echo $_SESSION['nu_id']; ?>";
    // _NETWORK_USER_ID = "131";
  <?php
} ?>

  var _IS_DEMO_FEATURE = false;
  <?php
    $demo_reconciliation = App::self('demo_view');
    if ($demo_reconciliation) { ?>
      _IS_DEMO_FEATURE = true;
    <?php
}
?>

  var _BASE_AIRING_LOG_BATCH = {
    active: false
  };

  var _BASE_FILTER_QUERY = {
    agencyId: '',
    startDate: moment(new Date()).subtract(2, 'days').format('YYYY-MM-DD'),
    endDate: moment(new Date()).format('YYYY-MM-DD')
  };

var FilterBarAgency = Vue.component('filter-bar-agency', {
  props: ['filterQuery','agencyId', 'agencyList', 'resetFilters', 'getAiringLogBatchList', 'resetFilters', 'startDate', 'endDate' ],
  template: `
    <section style="width:100%;">
      <form class="filters">
        <div>
          <label>Agency</label>
          <select v-model="filterQuery.agencyId">
            <option value="">All</option>
            <option v-for="agency in agencyList" v-bind:value="agency.id">{{agency.name}}</option>
          </select>
        </div>
        <div>
          <label>Start Date</label>
          <input type="date" name="endDateInput" v-model="filterQuery.startDate">
        </div>
        <div>
          <label>End Date</label>
          <input type="date" name="endDateInput" v-model="filterQuery.endDate">
        </div>
        <div style="padding:15px 0 0 0;">
          <span class="btn btn-secondary" @click="resetFilters()">Reset</span>
          <span class="btn btn-primary" @click="getAiringLogBatchList()">Search</span>
        </div>
      <div style="padding:15px 0px 0px;position:absolute;right:-5px">
      <span class="btn btn-primary" id="btnReset">Reset Panels</span>
      </div>
      </form>
    </section>`,
  data: function() {
    return {};
  },
});

var LogBatchRowsHeader = Vue.component('log-batch-rows-header', {
  props: [ 'setSortBy', 'sortByBatchReverse', 'sortByBatch'],
  template: `
    <div class="table-header">
    <table class="table mb0">
      <thead>
        <tr class="gray sub">
          <th style="width:500px;" @click="setSortBy('sortByBatch', 'name')" v-bind:class="['sortable', {active: sortByBatch == 'name'}]">
            Batch Name
            <span v-if="sortByBatch !== 'name' || sortByBatch == 'name' && sortByBatchReverse" class="fa fa-caret-down"></span>
            <span v-if="sortByBatch == 'name' && !sortByBatchReverse" class="fa fa-caret-up"></span>
          </th>
          <th style="width:300px;" @click="setSortBy('sortByBatch', 'adSupplierName')" v-bind:class="['sortable', {active: sortByBatch == 'adSupplierName'}]">
            Agency
            <span v-if="sortByBatch !== 'adSupplierName' || sortByBatch == 'adSupplierName' && sortByBatchReverse" class="fa fa-caret-down"></span>
            <span v-if="sortByBatch == 'adSupplierName' && !sortByBatchReverse" class="fa fa-caret-up"></span>
          </th>
          <th style="width:110px;" @click="setSortBy('sortByBatch', 'dateUploaded')" v-bind:class="['sortable', {active: sortByBatch == 'dateUploaded'}]">
            Date Uploaded
            <span v-if="sortByBatch !== 'dateUploaded' || sortByBatch == 'dateUploaded' && sortByBatchReverse" class="fa fa-caret-down"></span>
            <span v-if="sortByBatch == 'dateUploaded' && !sortByBatchReverse" class="fa fa-caret-up"></span>
          </th>
          <th style="width:110px;" @click="setSortBy('sortByBatch', 'timeUploaded')" v-bind:class="['sortable', {active: sortByBatch == 'timeUploaded'}]">
            Time Uploaded
            <span v-if="sortByBatch !== 'timeUploaded' || sortByBatch == 'timeUploaded' && sortByBatchReverse" class="fa fa-caret-down"></span>
            <span v-if="sortByBatch == 'timeUploaded' && !sortByBatchReverse" class="fa fa-caret-up"></span>
          </th>
          <th style="width:150px;" @click="setSortBy('sortByBatch', 'userName')" v-bind:class="['sortable', {active: sortByBatch == 'userName'}]">
            Uploaded By
            <span v-if="sortByBatch !== 'userName' || sortByBatch == 'userName' && sortByBatchReverse" class="fa fa-caret-down"></span>
            <span v-if="sortByBatch == 'userName' && !sortByBatchReverse" class="fa fa-caret-up"></span>
          </th>
          <th style="width:80px;" @click="setSortBy('sortByBatch', 'records')" v-bind:class="['sortable', {active: sortByBatch == 'records'}]">
            # Spots
            <span v-if="sortByBatch !== 'records' || sortByBatch == 'records' && sortByBatchReverse" class="fa fa-caret-down"></span>
            <span v-if="sortByBatch == 'records' && !sortByBatchReverse" class="fa fa-caret-up"></span>
          </th>
          <th style="width:80px;text-align:center;">Discrepancy</th>
          <th>&nbsp;</th>
        </tr>
      </thead>
    </table>
  </div>
  `,
    data: function() {
      return {};
    },
});

var LogBatchBody = Vue.component('log-batch-body', {
  props: ['decode', 'formatFilename', 'formatDate', 'formatTime', 'airingLogBatchList', 'saving', 'airingLogBatchesSorted', 'formatNumber', 'handleScroll', 'isDemoFeature', 'getAiringLogSpotDetail' ],
  template: `
    <div class="table-body" style="height: calc(100% - 63px) !important;" @scroll="handleScroll()">
      <table class="table mb0" id="airingLogBatchTable">
        <tbody v-if="airingLogBatchList.length === 0 && !saving">
          <tr>
            <td colspan="8" style="text-align:center;" class="noBorder">There are currently no Airing Log Batches to display.</td>
          </tr>
        </tbody>
        <tbody v-if="saving">
          <tr>
            <td colspan="8" style="text-align:center;" class="noBorder"><em class="fa fa-spinner"></em></td>
          </tr>
        </tbody>
        <tbody v-if="!saving" v-for="(log, logIndex) in airingLogBatchesSorted">
          <tr @click="getAiringLogSpotDetail(log.id, logIndex)" v-bind:class="['batchRow', {'active': log.active}]">
            <td style="width:500px;"><i class="nTip" v-bind:_title="formatFilename(log.name)">{{formatFilename(log.name)}}</i></td>
            <td style="width:300px;">{{decode(log.adSupplierName)}}</td>
            <td style="width:110px;">{{formatDate(log.uploaded)}}</td>
            <td style="width:110px;">{{formatTime(log.uploaded, true)}}</td>
            <td style="width:150px;">{{decode(log.userName)}}</td>
            <td style="width:80px;text-align:right">{{formatNumber(log.records)}}</td>
            <td style="width:80px;text-align:center;">
              <em v-if="isDemoFeature && logIndex === 2" class="fa fa-exclamation-circle error-text"></em>
            </td>
            <td>&nbsp;</td>
          </tr>
        </tbody>
      </table>
    </div>
  `,
    data: function() {
      return {};
    },
});

var LogBatchFooter = Vue.component('log-batch-footer', {
  props: ['displayBatchTotalSummary'],
  template: `
  <div class="table-footer">
    <table class="table mb0">
      <thead class="footer">
        <tr class="gray sub">
          <th style="width:500px;">&nbsp;</th>
          <th style="width:300px;">&nbsp;</th>
          <th style="width:110px;">&nbsp;</th>
          <th style="width:110px;">&nbsp;</th>
          <th style="width:150px;text-align:right;"><strong>Total Spots</strong></th>
          <th style="width:80px;text-align:right;"><b>{{ this.displayBatchTotalSummary() }}</b></th>
          <th style="width:80px;">&nbsp;</th>
          <th>&nbsp;</th>
        </tr>
      </thead>
    </table>
  </div> `,
    data: function() {
      return {};
    },
});

var SpotDetailHeader = Vue.component('spot-detail-header', {
  props: ['sortBySpot', 'setSortBy', 'sortBySpotReverse' ],
  template: `
    <div class="table-header">
      <table class="table mb0">
        <thead>
          <tr class="gray sub">
            <th style="width:80px;" @click="setSortBy('sortBySpot', 'spotID')" v-bind:class="['sortable', {active: sortBySpot == 'spotID'}]">
              Spot ID
              <span v-if="sortBySpot !== 'spotID' || this.ortBySpot == 'spotID' && sortBySpotReverse" class="fa fa-caret-down"></span>
              <span v-if="sortBySpot == 'spotID' && !sortBySpotReverse" class="fa fa-caret-up"></span>
            </th>
            <th style="width:125px;" @click="setSortBy('sortBySpot', 'agencyName')" v-bind:class="{active: sortBySpot == 'agencyName'}">
              Agency
              <span v-if="sortBySpot !== 'agencyName' || sortBySpot == 'agencyName' && sortBySpotReverse" class="fa fa-caret-down"></span>
              <span v-if="sortBySpot == 'agencyName' && !sortBySpotReverse" class="fa fa-caret-up"></span>
            </th>
            <th style="width:140px;" @click="setSortBy('sortBySpot', 'advertiser')" v-bind:class="{active: sortBySpot == 'advertiser'}">
              Client / Advertiser
              <span v-if="sortBySpot !== 'advertiser' || sortBySpot == 'advertiser' && sortBySpotReverse" class="fa fa-caret-down"></span>
              <span v-if="sortBySpot == 'advertiser' && !sortBySpotReverse" class="fa fa-caret-up"></span>
            </th>
            <th style="width:100px;" @click="setSortBy('sortBySpot', 'product')" v-bind:class="{active: sortBySpot == 'product'}">
              Product
              <span v-if="sortBySpot !== 'product' || sortBySpot == 'product' && sortBySpotReverse" class="fa fa-caret-down"></span>
              <span v-if="sortBySpot == 'product' && !sortBySpotReverse" class="fa fa-caret-up"></span>
            </th>
            <th style="width:140px;" @click="setSortBy('sortBySpot', 'station')" v-bind:class="{active: sortBySpot == 'station'}">
              Network / Station
              <span v-if="sortBySpot !== 'station' || sortBySpot == 'station' && sortBySpotReverse" class="fa fa-caret-down"></span>
              <span v-if="sortBySpot == 'station' && !sortBySpotReverse" class="fa fa-caret-up"></span>
            </th>
            <th style="width:60px;" @click="setSortBy('sortBySpot', 'orderNumber')" v-bind:class="{active: sortBySpot == 'orderNumber'}">
              Order #
              <span v-if="sortBySpot !== 'orderNumber' || sortBySpot == 'orderNumber' && sortBySpotReverse" class="fa fa-caret-down"></span>
              <span v-if="sortBySpot == 'orderNumber' && !sortBySpotReverse" class="fa fa-caret-up"></span>
            </th>
            <th style="width:120px;" @click="setSortBy('sortBySpot', 'isci')" v-bind:class="{active: sortBySpot == 'isci'}">
              ISCI / Ad ID
              <span v-if="sortBySpot !== 'isci' || sortBySpot == 'isci' && sortBySpotReverse" class="fa fa-caret-down"></span>
              <span v-if="sortBySpot == 'isci' && !sortBySpotReverse" class="fa fa-caret-up"></span>
            </th>
            <th style="width:90px;" @click="setSortBy('sortBySpot', 'spotTitle')" v-bind:class="['sortable', {active: sortBySpot == 'spotTitle'}]">
              Spot Title
              <span v-if="sortBySpot !== 'spotTitle' || sortBySpot == 'spotTitle' && sortBySpotReverse" class="fa fa-caret-down"></span>
              <span v-if="sortBySpot == 'spotTitle' && !sortBySpotReverse" class="fa fa-caret-up"></span>
            </th>
            <th style="width:90px;" @click="setSortBy('sortBySpot', 'airedStatus')" v-bind:class="{active: sortBySpot == 'airedStatus'}">
              Aired Status
              <span v-if="sortBySpot !== 'airedStatus' || sortBySpot == 'airedStatus' && sortBySpotReverse" class="fa fa-caret-down"></span>
              <span v-if="sortBySpot == 'airedStatus' && !sortBySpotReverse" class="fa fa-caret-up"></span>
            </th>
            <th style="width:80px;" @click="setSortBy('sortBySpot', 'date')" v-bind:class="{active: sortBySpot == 'date'}">
              Date
              <span v-if="sortBySpot !== 'date' || sortBySpot == 'date' && sortBySpotReverse" class="fa fa-caret-down"></span>
              <span v-if="sortBySpot == 'date' && !sortBySpotReverse" class="fa fa-caret-up"></span>
            </th>
            <th style="width:80px;" @click="setSortBy('sortBySpot', 'time')" v-bind:class="{active: sortBySpot == 'time'}">
              Time
              <span v-if="sortBySpot !== 'time' || sortBySpot == 'time' && sortBySpotReverse" class="fa fa-caret-down"></span>
              <span v-if="sortBySpot == 'time' && !sortBySpotReverse" class="fa fa-caret-up"></span>
            </th>
            <th style="width:55px;" @click="setSortBy('sortBySpot', 'length')" v-bind:class="{active: sortBySpot == 'length'}">
              Length
              <span v-if="sortBySpot !== 'length' || sortBySpot == 'length' && sortBySpotReverse" class="fa fa-caret-down"></span>
              <span v-if="sortBySpot == 'length' && !sortBySpotReverse" class="fa fa-caret-up"></span>
            </th>
            <th style="width:80px;" @click="setSortBy('sortBySpot', 'cost')" v-bind:class="{active: sortBySpot == 'cost'}">
              Spot Cost
              <span v-if="sortBySpot !== 'cost' || sortBySpot == 'cost' && sortBySpotReverse" class="fa fa-caret-down"></span>
              <span v-if="sortBySpot == 'cost' && !sortBySpotReverse" class="fa fa-caret-up"></span>
            </th>
            <th style="width:80px;" @click="setSortBy('sortBySpot', 'estimate')" v-bind:class="{active: sortBySpot == 'estimate'}">
              Estimate #
              <span v-if="sortBySpot !== 'estimate' || sortBySpot == 'estimate' && sortBySpotReverse" class="fa fa-caret-down"></span>
              <span v-if="sortBySpot == 'estimate' && !sortBySpotReverse" class="fa fa-caret-up"></span>
            </th>
            <th style="width:120px;" @click="setSortBy('sortBySpot', 'dayPart')" v-bind:class="{active: sortBySpot == 'dayPart'}">
              Daypart
              <span v-if="sortBySpot !== 'dayPart' || sortBySpot == 'dayPart' && sortBySpotReverse" class="fa fa-caret-down"></span>
              <span v-if="sortBySpot == 'dayPart' && !sortBySpotReverse" class="fa fa-caret-up"></span>
            </th>
            <th style="width:120px;" @click="setSortBy('sortBySpot', 'sellingTitle')" v-bind:class="{active: sortBySpot == 'sellingTitle'}">
              Selling Title
              <span v-if="sortBySpot !== 'sellingTitle' || sortBySpot == 'sellingTitle' && sortBySpotReverse" class="fa fa-caret-down"></span>
              <span v-if="sortBySpot == 'sellingTitle' && !sortBySpotReverse" class="fa fa-caret-up"></span>
            </th>
            <th style="width:150px;" @click="setSortBy('sortBySpot', 'program')" v-bind:class="['last', {active: sortBySpot == 'program'}]">
              Program
              <span v-if="sortBySpot !== 'program' || sortBySpot == 'program' && sortBySpotReverse" class="fa fa-caret-down"></span>
              <span v-if="sortBySpot == 'program' && !sortBySpotReverse" class="fa fa-caret-up"></span>
            </th>
          </tr>
        </thead>
      </table>
    </div> `,
    data: function() {
      return {};
    },
});

var SpotSummary = Vue.component('spot-summary', {
  props: ['shouldHide', 'saving', 'displayTotalSummary', 'decode', 'formatNumber', 'clientSummarySorted', 'stationSummarySorted' ],
  template: `
    <div class="outside">
      <header class="title" >
        Summary of Spots for the selected batch
        <span class="toggleShowHide"><em title="Hide section" class="fa fa-minus"></em></span>
      </header>
      <div id="bottom" style="height:180px;">
        <section style="width:100%;height:100%;" id="spotSummaryTables" v-if="!shouldHide.spotSummary">
          <div>
            <table class="table">
              <thead>
                <tr class="gray sub"><th colspan="2">Total Spots Summary</th></tr>
              </thead>
              <tbody v-if="!saving">
                <tr>
                  <td><strong>Value</strong></td>
                  <td><strong># of Spots</strong></strong></td>
                </tr>
                <tr>
                  <td>Total</td>
                  <td>{{displayTotalSummary('total')}}</td>
                </tr>
                <tr>
                  <td>Pre-Logs</td>
                  <td>{{displayTotalSummary('S')}}</td>
                </tr>
                <tr>
                  <td>Post-Logs</td>
                  <td>{{displayTotalSummary('A')}}</td>
                </tr>
                <tr>
                  <td>Did Not Air</td>
                  <td>{{displayTotalSummary('N')}}</td>
                </tr>
              </tbody>
              <tbody v-if="saving">
                <tr>
                  <td colspan="2" style="text-align:center;"><em class="fa fa-spinner"></em></td>
                </tr>
              </tbody>
            </table>
          </div>

          <div>
            <table class="table mb0">
              <thead>
                <tr class="gray sub"><th colspan="2">Spots Summary by Advertiser / Client</th></tr>
              </thead>
            </table>
            <div class="table-scroll" style="min-height:145px;">
              <table class="table summaryTable">
                <tbody v-if="saving">
                  <tr>
                    <td colspan="2" style="text-align:center;"><em class="fa fa-spinner"></em></td>
                  </tr>
                </tbody>
                <tbody v-if="!saving">
                  <tr>
                    <td><strong>Advertiser / Client</strong></td>
                    <td><strong># of Spots</strong></strong></td>
                  </tr>
                  <tr v-for="client in clientSummarySorted">
                    <td>{{decode(client.label)}}</td>
                    <td>{{formatNumber(client.count)}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <div>
            <table class="table mb0">
              <thead>
                <tr class="gray sub"><th colspan="2">Spots Summary by Network / Station</th></tr>
              </thead>
            </table>
            <div class="table-scroll" style="min-height:145px;">
              <table class="table">
                <tbody v-if="saving">
                  <tr>
                    <td colspan="2" style="text-align:center;"><em class="fa fa-spinner"></em></td>
                  </tr>
                </tbody>
                <tbody v-if="!saving">
                  <tr>
                    <td><strong>Network / Station</strong></td>
                    <td><strong># of Spots</strong></strong></td>
                  </tr>
                  <tr v-for="station in stationSummarySorted">
                    <td>{{station.label}}</td>
                    <td>{{formatNumber(station.count)}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          </section>
        </div>
      </div>
    </div> `,
    data: function() {
      return {};
    },
});

var SpotBody = Vue.component('spot-body', {
  props: ['handleScroll', 'spotDetails', 'savingDetail', 'isDemoFeature', 'spotDetailsSorted', 'decode', 'displayStatus', 'formatDate', 'formatTime', 'formatCurrency' ],
  template: `
  <div class="table-body" @scroll="handleScroll">
    <table class="table mb0" id="spotDetailTable">
      <tbody v-if="spotDetails.length === 0 && !savingDetail">
        <tr>
          <td colspan="16" style="width:1380px;text-align:center;" class="noBorder">Select an Airing Log Batch above to view its Spot Detail.</td>
        </tr>
      </tbody>
      <tbody v-if="savingDetail">
        <tr>
          <td colspan="16" style="text-align:center;" class="noBorder"><em class="fa fa-spinner"></em></td>
        </tr>
      </tbody>
      <tbody v-if="!savingDetail" v-for="(spotDetail, spotDetailIndex) in spotDetailsSorted">
        <tr v-bind:class="{discrepancy: (isDemoFeature && spotDetailIndex === 4)}">
          <td style="width:80px;"><i class="nTip" v-bind:_title="spotDetail.spotID">{{spotDetail.spotID}}</i></td>
          <td style="width:125px;"><i class="nTip" v-bind:_title="spotDetail.agencyName">{{decode(spotDetail.agencyName)}}</i></td>
          <td style="width:140px;"><i class="nTip" v-bind:_title="spotDetail.advertiser">{{decode(spotDetail.advertiser)}}</i></td>
          <td style="width:100px;"><i class="nTip" v-bind:_title="spotDetail.product">{{spotDetail.product}}</i></td>
          <td style="width:140px;"><i class="nTip" v-bind:_title="spotDetail.station">{{spotDetail.station}}</i></td>
          <td style="width:60px;"><i class="nTip" v-bind:_title="spotDetail.orderNumber">{{spotDetail.orderNumber}}</i></td>
          <td style="width:120px;">
            <i v-if="!isDemoFeature" class="nTip" v-bind:_title="spotDetail.isci">{{spotDetail.isci}}</i>
            <a v-if="isDemoFeature" href="#" class="nTip" v-bind:_title="spotDetail.isci" data-toggle="modal" data-target="#demoCIModal" style="color:#60a3fb;text-decoration:underline;">{{spotDetail.isci}}</a>
          </td>
          <td style="width:90px;"><i class="nTip" v-bind:_title="spotDetail.spotTitle">{{spotDetail.spotTitle}}</i></td>
          <td style="width:90px;"><i>{{displayStatus(spotDetail.state)}}</i></td>
          <td style="width:80px;"><i>{{formatDate(spotDetail.date)}}</i></td>
          <td style="width:80px;"><i>{{formatTime(spotDetail.date, true)}}</i></td>
          <td style="width:55px;text-align:right;"><i>{{spotDetail.length}}</i></td>
          <td style="width:80px;text-align:right;"><i>{{formatCurrency(spotDetail.cost)}}</i></td>
          <td style="width:80px;"><i class="nTip" v-bind:_title="spotDetail.estimate">{{spotDetail.estimate}}</i></td>
          <td style="width:120px;"><i class="nTip" v-bind:_title="spotDetail.dayPart">{{spotDetail.dayPart}}</i></td>
          <td style="width:120px;"><i class="nTip" v-bind:_title="spotDetail.sellingTitle">{{spotDetail.sellingTitle}}</i></td>
          <td style="width:150px;" class="last"><i class="nTip" v-bind:_title="spotDetail.program">{{spotDetail.program}}</i></td>
        </tr>
      </tbody>
    </table>
  </div>
  `,
    data: function() {
    return {};
  },
})

var MySpotSummary = Vue.component('my-spot-summary', {
  template: `
    <vuetable ref="vuetable"
      :fields="[ 'name', 'Spot ID', 'Agency', 'Client / Advertiser', 'Product', 'Network / Station', 'Order #', 'ISCI / Ad ID', 'Spot Title', 'Aired Status', 'Date', 'Time', 'Length', 'Spot Cost', 'Estimate #', Daypart']"
      pagination-path=""
    >
    </vuetable>
  `,
    data: function() {
    return {};
  },
})

var MyAiringLogs = Vue.component('my-airing-logs', {
  template: `
    <vuetable
    :fields="[ 'Batch Name', 'Agency', 'Date Uploaded', 'Time Uploaded', 'Uploaded By', '# Spots', 'Discrepancy']"
    pagination-path=""
    >
    </vuetable>
  `,
  data: function() {
    return {};
  },
})

Vue.use(Vuetable);

var app = new Vue({
  el: '#airingLogBatchesNetworkApp',
  components: {
    // 'LogBatchRowsHeader': LogBatchRowsHeader,
    // 'LogBatchBody' : LogBatchBody,
    // 'LogBatchFooter' : LogBatchFooter,
    // 'SpotDetailHeader': SpotDetailHeader,
    // 'SpotSummary' : SpotSummary,
    // 'SpotBody' : SpotBody,
    // 'FilterBarAgency' : FilterBarAgency,
    // 'MyVuetable' : MyVuetable,
    // 'MyAiringLogs' : MyAiringLogs,
    // 'MySpotSummary' : MySpotSummary
  },
  created() {
    this.getAiringLogBatchList();
  },
  mounted() {
    this.agencyList = <?php echo json_encode($agencies); ?>;
  },
  updated() {
  },
  data: function() {
    return {
    agencyList: [],
    airingLogBatchList: [],
    clientSummary: {},
    filterQuery: $.extend(true, {}, _BASE_FILTER_QUERY),
    isDemoFeature: _IS_DEMO_FEATURE,
    saving: false,
    savingDetail: false,
    shouldHide: {},
    sortByBatch: '',
    sortByBatchReverse: false,
    sortBySpot: '',
    sortBySpotReverse: false,
    spotDetails: [],
    stationSummary: {},
    totalSummary: {}
    };
  },
  computed: {
    spotDetailsSorted: function () {
      if (this.sortBySpot === '') return this.spotDetails;
      var that = this;
      var sorted = this.spotDetails.sort(function (a, b) {
        return that.compare(a, b, that.sortBySpot);
      });

      if (!this.sortBySpotReverse) sorted.reverse();
      return sorted;
    },
    airingLogBatchesSorted: function () {
      if (this.sortByBatch === '') return this.airingLogBatchList;
      var that = this;
      var sorted = this.airingLogBatchList.sort(function (a, b) {
        return that.compare(a, b, that.sortByBatch);
      });

      if (!this.sortByBatchReverse) sorted.reverse();
      return sorted;
    },
    clientSummarySorted: function () {
      return _.sortBy(this.clientSummary, 'label');
    },
    stationSummarySorted: function () {
      return _.sortBy(this.stationSummary, 'label');
    }
  },
  methods: {
    trim: function (str) {
      return str.trim().toLowerCase();
    },
    exists: function (value) {
      if (value === undefined || value === '' || value === null) return false;
      else return true;
    },
    compare: function (a, b, property) {
      if (a[property] < b[property])
        return -1;
      if (a[property] > b[property])
        return 1;
      return 0;
    },
    decode: function (str) {
      console.log('decode');
      var text = document.createElement('textarea');
      text.innerHTML = str;
      return text.value;
    },
    idToName: function (arrayName, id) {
      if (id === undefined || id === '' || id === null) return '';
      var obj = this[arrayName].find(item => {
        return item.id == id; // Normal comparsion operator to avoid the data type mismatch.
      });
      if (obj === undefined) return '';
      return obj.name;
    },
    nameToId: function (arrayName, name) {
      if (name === undefined || name === '' || name === null) return '';
      var obj = this[arrayName].find(item => {
        return item.name === name;
      });
      if (obj === undefined) return '';
      return obj.id;
    },
    setSortBy: function (sortTable, sortBy) {
      console.log('set sort by function');
      // @TODO: redo this whole function because it's hacky but
      // Sam wants this done yesterday so the only goal is to get it working for now

      // Set sortBy and reverse
      if (this[sortTable] === sortBy) {
        this[sortTable + 'Reverse'] = !this[sortTable + 'Reverse'];
      }
      this[sortTable] = sortBy;

      // Set properties that don't exist or change data type
      if (sortTable === 'sortByBatch') {
        if (sortBy === 'timeUploaded' || sortBy === 'dateUploaded') {
          for (var i = 0; i < this.airingLogBatchList.length; i++) {
            var currentLog = this.airingLogBatchList[i];
            currentLog.timeUploaded = currentLog.uploaded;
            currentLog.dateUploaded = this.formatDate(currentLog.uploaded);
          }
        }
      }

      else if (sortTable === 'sortBySpot') {
        if (sortBy === 'time' || sortBy === 'date') {
          for (var i = 0; i < this.airingLogBatchList.length; i++) {
            var currentSpot = this.airingLogBatchList[i];
            currentSpot.date = this.formatDate(currentSpot.date);
            currentSpot.time = currentSpot.date;
          }
        }
        else if (sortBy === 'length' || sortBy === 'cost') {
          for (var i = 0; i < this.spotDetails.length; i++) {
            this.spotDetails[i]['length'] = parseInt(this.spotDetails[i]['length']);
            this.spotDetails[i].cost = parseInt(this.spotDetails[i].cost);
          }
        }

      }
    },
    formatDate: function (date) {
      console.log('format date function');
      if (!moment(date).isValid()) return '';
      return moment(date).format('MM/DD/YYYY');
    },
    formatTime: function (date, showSec) {
      console.log('format time function');
      if (!moment(date).isValid()) return '';
      if (showSec) return moment(date).format('hh:mm:ss a');
      return moment(date).format('hh:mm a');
    },
    formatFilename: function (filename) {
      console.log('format file name function', filename);
      return filename.split('.xlsx')[0];
    },
    resetFilters: function () {
      this.filterQuery = $.extend(true, {}, _BASE_FILTER_QUERY);
    },
    displayStatus: function (status) {
      if (status === 'S') return 'Scheduled';
      else if (status === 'A') return 'Aired/Post Log';
      else if (status === 'N') return 'Did not air';
      else return '';
    },
    displayTotalSummary: function (displayType) {
      var total = 0;
      for (var i = 0; i < this.totalSummary.length; i++) {
        if (displayType === 'total') {
          total += this.totalSummary[i].count;
        } else if (displayType === 'S') {
          if (this.totalSummary[i].label === 'S') return this.totalSummary[i].count.toLocaleString('en-US');
        } else if (displayType === 'A') {
          if (this.totalSummary[i].label === 'A') return this.totalSummary[i].count.toLocaleString('en-US');
        } else if (displayType === 'N') {
          if (this.totalSummary[i].label === 'N') return this.totalSummary[i].count.toLocaleString('en-US');
        }
      }
      return total.toLocaleString('en-US');
    },
    displayBatchTotalSummary: function() {
      var total = this.airingLogBatchList
        .map(al => al.records)
        .reduce((a, b) => a + b, 0)
        .toLocaleString('en-US');
      return total;
    },
    formatCurrency: function (amount) {
      return amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,').toLocaleString('en-US');
    },
    formatNumber: function (num) {
      return num.toLocaleString('en-US');
    },
    toggleHideSection: function (section) {
      if (!this.exists(this.shouldHide[section])) {
        Vue.set(app.shouldHide, section, true);
      } else {
        Vue.set(app.shouldHide, section, !this.shouldHide[section])
      }
    },
    handleScroll: function (evt) {
      if (evt.target.className === 'table-body') {
        var $header = $($($(evt.srcElement)[0]).parent().find('.table-header')[0]);
        var $body = $($(evt.srcElement)[0]);
        $header.offset({ left: -1 * $body.scrollLeft() + $body.offset().left });
      }
    },
    getAiringLogBatchList: function () {
      this.saving = true;
      this.savingDetail = true;

      $.ajax({
        url: '<?php echo API_URL_AIRINGLOGS; ?>api/AiringLogBatches?code=<?php echo API_URL_AIRINGLOGS_BATCHES_CODE; ?>&networkUserId=' + _NETWORK_USER_ID + '&numberOfDays=1&startDate=' + this.filterQuery.startDate + '&endDate=' + this.filterQuery.endDate + '&agencyId=' + this.filterQuery.agencyId,
        method: 'GET',
        dataType: 'json',
        beforeSend: function (xhr) {
          xhr.setRequestHeader('Authorization', '<?php echo $_SESSION['jwt']; ?>');
        },
        success: function (response) {
          this.airingLogBatchList = response.batches;
          for (var i = 0; i < this.airingLogBatchList.length; i++) {
            this.airingLogBatchList[i] = $.extend(true, this.airingLogBatchList[i], _BASE_AIRING_LOG_BATCH);
            this.airingLogBatchList.reverse();
          }

          this.clientSummary = response.clientSummary;
          this.stationSummary = response.stationSummary;
          this.totalSummary = response.totalSummary;
          this.spotDetails = [];
          this.saving = false;
          this.savingDetail = false;
        }.bind(this),
        error: function (err) {
          this.saving = false;
          this.savingDetail = false;
          console.log('Error: ', err);
        }
      });
    },
    getAiringLogSpotDetail: function (batchId, logIndex) {
      // Set other logs as inactive
      for (var i = 0; i < this.airingLogBatchList.length; i++) {
        var airingLog = this.airingLogBatchList[i];
        airingLog.active = false;
        Vue.set(app.airingLogBatchList, i, airingLog);
      }

      // Set current log to active
      var newAiringLog = this.airingLogBatchList[logIndex];
      newAiringLog.active = true;
      Vue.set(app.airingLogBatchList, logIndex, newAiringLog);

      // Get spot detail
      this.savingDetail = true;
      $.ajax({
        url: '<?php echo API_URL_AIRINGLOGS; ?>/api/AiringLogs?code=<?php echo API_URL_AIRINGLOGS_AIRINGLOG_CODE; ?>&networkUserId=' + _NETWORK_USER_ID + '&batchId=' + batchId,
        method: 'GET',
        dataType: 'json',
        beforeSend: function (xhr) {
          xhr.setRequestHeader('Authorization', '<?php echo $_SESSION['jwt']; ?>');
        },
        success: function (response) {
          this.spotDetails = response.airingLogs;
          this.clientSummary = response.clientSummary;
          this.stationSummary = response.stationSummary;
          this.totalSummary = response.totalSummary;
          this.savingDetail = false;
        }.bind(this),
        error: function (err) {
          this.savingDetail = false;
          console.log('Error: ', err);
        }
      });
    }
  }
});

</script>

<script type="text/javascript">

  $('#btnReset').click(function () {
        var hi = 190; // set this to start height
        t.height(hi);
        m.height(hi);
        b.height(hi);

        t.show();
        m.show();
        b.show();

        //Reset the memory
        H['top'] = hi;
        H['middle'] = hi;
        H['bottom'] = hi;

        //Turn all the scrolls back on
        h.css('visibility','visible');
        h1.css('visibility','visible');

        //change all icons
        $(".fa").removeClass('fa-plus').addClass('fa-minus');

    });
</script>

<script type="text/javascript">

    var h = $('#handle'),
        h1 = $('#handle1'),
        t = $('#top'),
        m = $('#middle'),
        b = $('#bottom');

    var H = new Object(); // or just {}
        H['top'] = t.height();
        H['middle'] = m.height();
        H['bottom'] = b.height();

    var mClickStart;

    var isDragging = false;
    var isDragging1 = false;

    $('.toggleShowHide').click(function () {
        if ($(this).find($(".fa")).hasClass('fa-plus')) {
            //Expand Function
            if ($(this).parent().parent().children()[1].id == "top" || $(this).parent().parent().children()[1].id == "bottom") {

                if(b.parent().find($(".fa")).hasClass('fa-plus') && m.parent().find($(".fa")).hasClass('fa-plus')){
                    //remove extra from Top
                    t.height(H['top'] - H['bottom']);
                    H['top'] = t.height();
                }else{
                    //Remove extra from middle
                    m.height(m.height() - $($(this).parent().parent()[0].children[1]).height());
                    H['middle'] = m.height();
                }
            }
            if ($(this).parent().parent().children()[1].id == "middle") {
                if(m.parent().find($(".fa")).hasClass('fa-plus') && t.parent().find($(".fa")).hasClass('fa-plus')){
                    //Remove Extra to bottom
                    b.height(H['bottom'] - H['middle']);
                    H['bottom'] = b.height();
                }else{
                    //Remove from Top
                    t.height(t.height() - $($(this).parent().parent()[0].children[1]).height());
                    H['top'] = t.height();
                }
            }
            if($(this).parent().parent().children()[1].id == "top"){
                h.css('visibility','visible');
            }
            if($(this).parent().parent().children()[1].id == "middle"){
                h.css('visibility','visible');
                h1.css('visibility','visible');
            }

            $('#' + $(this).parent().parent().children()[1].id).show();
            $(this).find($(".fa")).removeClass('fa-plus').addClass('fa-minus');
        } else {
            //Collapse Functions
            if ($(this).parent().parent().children()[1].id == "top" || $(this).parent().parent().children()[1].id == "bottom") {
                if(b.parent().find($(".fa")).hasClass('fa-minus') && m.parent().find($(".fa")).hasClass('fa-plus')){
                    //Add extra to top
                    t.height(t.height() + $($(this).parent().parent()[0].children[1]).height());
                    H['top'] = t.height();
                }else{
                //Add extra to middle
                    m.height(m.height() + $($(this).parent().parent()[0].children[1]).height());
                    H['middle'] = m.height();
                }
            }
            if ($(this).parent().parent().children()[1].id == "middle") {
                //check if booth top is closed add room to bottom
                if(m.parent().find($(".fa")).hasClass('fa-minus') && t.parent().find($(".fa")).hasClass('fa-plus')){
                    //Add Extra to bottom
                    b.height(t.height() + $($(this).parent().parent()[0].children[1]).height());
                    H['bottom'] = b.height();
                }else{
                    //Add extra to top
                    t.height(t.height() + $($(this).parent().parent()[0].children[1]).height());
                    H['top'] = t.height();
                }
            }

                        //Dissable the Slider
            if($(this).parent().parent().children()[1].id == "top"){
                h.css('visibility','hidden');
            }
            if($(this).parent().parent().children()[1].id == "middle"){
                h.css('visibility','hidden');
                h1.css('visibility','hidden');
            }

            $('#' + $(this).parent().parent().children()[1].id).hide();
            $(this).find($(".fa")).removeClass('fa-minus').addClass('fa-plus');
        }
    });

    h.mousedown(function (e) {
        isDragging = true;
        mClickStart = e.pageY;
        $('body').css('cursor', 'row-resize');
        e.preventDefault();
    }).mouseover(function () {
        $('body').css('cursor', 'row-resize');
    }).mouseout(function () {
        if (!isDragging && !isDragging1) {
            $('body').css('cursor', 'auto');
        }
    });

    h1.mousedown(function (e) {
        isDragging1 = true;
        mClickStart = e.pageY;
        $('body').css('cursor', 'row-resize');
        e.preventDefault();
    }).mouseover(function () {
        $('body').css('cursor', 'row-resize');
    }).mouseout(function () {
        if (!isDragging && !isDragging1) {
            $('body').css('cursor', 'auto');
        }
    });

    $(document).mouseup(function () {
        isDragging = false;
        isDragging1 = false;
        //Keep for expand collapse function
        H['top'] = t.height();
        H['middle'] = m.height();
        H['bottom'] = b.height();
        $('body').css('cursor', 'auto');
    }).mousemove(function (e) {
        if (isDragging) {
            var topP =  e.pageY - mClickStart;
            if(H['middle'] - topP > 0 && H['top'] + topP > 0){
                t.css('height', H['top'] + topP);
                m.css('height', H['middle'] - topP);
            }
        }
        if (isDragging1) {
            var middleP =  e.pageY - mClickStart;
            if(H['bottom'] - middleP > 0 && H['middle'] + middleP > 0){
                m.css('height', H['middle'] + middleP);
                b.css('height', H['bottom'] - middleP);
            }
        }
    });

</script>
