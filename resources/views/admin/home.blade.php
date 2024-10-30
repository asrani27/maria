@extends('layouts.app')
@push('css')

@endpush
@section('content')
<div class="row text-center">
  <H2>SELAMAT DATANG DI APLIKASI <br/>DISBUDPORAPAR</H2>
</div>
<br/>
<br/>
<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">PETUGAS</span>
        <span class="info-box-number">{{petugas()}}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-red"><i class="fa fa-list"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">KATEGORI</span>
        <span class="info-box-number">{{kategori()}}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

  <!-- fix for small devices only -->
  <div class="clearfix visible-sm-block"></div>

  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-green"><i class="fa fa-building"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">CAGAR BUDAYA</span>
        <span class="info-box-number">{{cagar()}}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="fa fa-calendar"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">JADWAL MONITORING</span>
        <span class="info-box-number">{{jadwal()}}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
</div>


@endsection
@push('js')

<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
{{-- 
<script>

  var kecamatan = {!!json_encode($kecamatan)!!}
  var dpt = {!!json_encode($dpt)!!}
  var sahabat = {!!json_encode($sahabat)!!}
  
  </script> --}}

<script>
  window.onload = function () {
  
  var chart = new CanvasJS.Chart("chartContainer", {
    exportEnabled: true,
    animationEnabled: true,
    title:{
      text: "Total Pengunjung"
    },
    subtitles: [{
      text: "Prediksi Pengunjung"
    }], 
    axisX: {
      title: "Kecamatan"
    },
    axisY: {
      title: "DPT Terdaftar",
      titleFontColor: "#4F81BC",
      lineColor: "#4F81BC",
      labelFontColor: "#4F81BC",
      tickColor: "#4F81BC",
      includeZero: true
    },
    axisY2: {
      title: "Data Sahabat",
      titleFontColor: "#C0504E",
      lineColor: "#C0504E",
      labelFontColor: "#C0504E",
      tickColor: "#C0504E",
      includeZero: true
    },
    toolTip: {
      shared: true
    },
    legend: {
      cursor: "pointer",
      itemclick: toggleDataSeries
    },
    data: [{
      type: "column",
      name: "Pengunjung",
      showInLegend: true,      
      yValueFormatString: "#,##0.# Org",
      dataPoints: [
        { label: "BJM BARAT",  y: kecamatan[0].dpt },
        { label: "BJM SELATAN", y: kecamatan[1].dpt },
        { label: "BJM TIMUR", y: kecamatan[2].dpt },
        { label: "BJM TENGAH",  y: kecamatan[3].dpt },
        { label: "BJM UTARA",  y: kecamatan[4].dpt }
      ]
    },
    {
      type: "column",
      name: "Sahabat",
      axisYType: "secondary",
      showInLegend: true,
      yValueFormatString: "#,##0.# Org",
      dataPoints: [
        { label: "BJM BARAT",  y: kecamatan[0].sahabat },
        { label: "BJM SELATAN", y: kecamatan[1].sahabat },
        { label: "BJM TIMUR", y: kecamatan[2].sahabat },
        { label: "BJM TENGAH",  y: kecamatan[3].sahabat },
        { label: "BJM UTARA",  y: kecamatan[4].sahabat }
      ]
    }]
  });
  chart.render();
  
  function toggleDataSeries(e) {
    if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
      e.dataSeries.visible = false;
    } else {
      e.dataSeries.visible = true;
    }
    e.chart.render();
  }
  
  
}

function explodePie (e) {
	if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
	} else {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
	}
	e.chart2.render();

  }
  </script>
@endpush
