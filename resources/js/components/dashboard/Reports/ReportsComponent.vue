<template>
  <div>
    <Breadcrumb
      homeName="Dashboard"
      homeUrl="/"
      activeName="Users"
      :breadcrumbbar="true"
    ></Breadcrumb>

    <div class="row" v-can="'SaleReportView'">
      <div class="col-md-2 col-sm-6 col-xs-4 float-right">
        <button
          type="button"
          value=""
          class=".btn-sm btn-primary form-control mb-4"
          @click="openPopup"
          style="height: auto"
        >
          Generate report
        </button>
      </div>
      <br />
    </div>
    <!--/ Miscellaneous Charts -->

    <!-- Table Hover Animation start -->

    <div class="col-xl-12 col-md-12 col-12" v-show="isReport">
      <div class="card card-statistics">
        <div class="card-header">
          <h4 class="card-title">Statistics</h4>
          <div class="d-flex align-items-center">
            <h4 class="card-text font-small-2 mr-25 mb-0">
              Updated
              <strong class="text-success mr-1">{{ startdate }}</strong> To
              <strong class="ml-1 text-danger">{{ enddate }}</strong>
            </h4>
          </div>
        </div>
        <div class="card-body statistics-body">
          <div class="row">
            <div class="col-xl-4 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="media">
                <div class="avatar bg-light-primary mr-2">
                  <div class="avatar-content">
                    <i data-feather="trending-up" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="media-body my-auto">
                  <h4 class="font-weight-bolder mb-0">
                    ${{ this.totalSale }}
                  </h4>
                  <p class="card-text font-small-3 mb-0">Sales</p>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-sm-6 col-12 mb-2 mb-sm-0">
              <div class="media">
                <div class="avatar bg-light-danger mr-2">
                  <div class="avatar-content">
                     <i data-feather="dollar-sign" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="media-body my-auto">
                  <h4 class="font-weight-bolder mb-0">
                    ${{ this.totaldiscount }}
                  </h4>
                  <p class="card-text font-small-3 mb-0">Discount</p>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-sm-6 col-12">
              <div class="media">
                <div class="avatar bg-light-success mr-2">
                  <div class="avatar-content">
                    <i data-feather="dollar-sign" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="media-body my-auto">
                  <h4 class="font-weight-bolder mb-0">
                    ${{ this.totalRevenue }}
                  </h4>
                  <p class="card-text font-small-3 mb-0">Revenue</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row" id="table-hover-animation" v-show="isReport">
      <hr />
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Custom Reports</h4>
            <div class="d-flex align-items-center">
              <h4 class="card-text font-small-2 mr-25 mb-0">
                Updated
                <strong class="text-success mr-1">{{ startdate }}</strong> To
                <strong class="ml-1 text-danger">{{ enddate }}</strong>
              </h4>
            </div>
          </div>
          <div class="card-body">
            <div class="card-text row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="col-md-4"></div>
              </div>
            </div>
          </div>
          <b-overlay :show="isLoading" variants="transparent" rounded="md">
            <div class="row">
              <div class="col-lg-8 col-sm-12 col-md-12 col-8">
                <div class="card">
                  <div class="card-body pb-50">
                    <!-- <h6>Last 7 Days Orders</h6> -->
                    <div class="d-flex align-items-center">
            <h4 class="card-text font-small-2 mr-25 mb-0">
              Updated
              <strong class="text-success mr-1">{{ startdate }}</strong> To
              <strong class="ml-1 text-danger">{{ enddate }}</strong>
            </h4>
          </div>
                    <h2 class="font-weight-bolder mb-1 mt-2">${{ totalSale }}</h2>
                    <div id="chart"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 ">
                                <div class="card earnings-card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <h4 class="card-title mb-1">Earnings</h4>
                                                <div class="font-small-2">Total Revenue</div>
                                                <h5 class="mb-1 mt-2">${{totalRevenue}}</h5>
                                                <!-- <p class="card-text text-muted font-small-2">
                                                    <span class="font-weight-bolder">68.2%</span><span> more
                                                        earnings than last month.</span>
                                                </p> -->
                                            </div>

                                        </div>
                                        <div class="col-12">
                                                <div id="weeklypieChart"></div>
                                            </div>
                                    </div>
                                </div>
                            </div>
            </div>
          </b-overlay>

          <!-- Table -->
        </div>
      </div>
    </div>
    <!-- Table head options end -->
    <!-- Modal -->
    <div
      class="modal fade text-left"
      id="modal_id"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myModalLabel17"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Generate New Report</h4>

            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <b-form v-on:submit.prevent="onSubmit">
              <div class="block">
                <div class="row">
                  <div class="col">
                    <b-form-datepicker
                      v-model="startdate"
                       locale="en"
                      :required="true"
                    ></b-form-datepicker>
                    <b-form-invalid-feedback :state="StartdateValidate">
                      Start Date is required
                    </b-form-invalid-feedback>
                  </div>
                  <span class="mt-1">To</span>
                  <div class="col">
                    <b-form-datepicker
                      v-model="enddate"
                      locale="en"
                      :required="true"
                    ></b-form-datepicker>
                    <b-form-invalid-feedback :state="EnddateValidate">
                      End Date is required
                    </b-form-invalid-feedback>
                  </div>
                </div>
              </div>
              <div class="float-right mt-3">
                <b-button type="submit" variant="success">Generate</b-button>

                <b-button type="reset" variant="danger" data-dismiss="modal"
                  >Close</b-button
                >
                <!-- <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button> -->
              </div>
            </b-form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>



<script>
import Breadcrumb from "../Breadcrumb/BreadcrumbComponent";

export default {
  components: {
    Breadcrumb,
  },
  computed: {
    StartdateValidate() {
      if (this.startdate == "") {
        return false;
      }
    },
    EnddateValidate() {
      if (this.enddate == "") {
        return false;
      }
    },
  },
  data() {
    return {
      startdate: "",
      enddate: "",
      isLoading: false,
      customsale: [],
      totalSale: 0,
      totalRevenue: 0,
      totaldiscount: 0,
      isReport: false,
    };
  },
  methods: {
    resetForm() {
      this.startdate = "";
      this.enddate = "";
      this.isReport = false;
    },
    openPopup() {
      this.resetForm();
      $("#modal_id").modal("show");
    },
    onSubmit() {
      if (this.startdate != "" && this.enddate != "") {
        this.isLoading = true;
        let formdata = new FormData();
        formdata.append("startdate", this.startdate);
        formdata.append("enddate", this.enddate);
        axios
          .post(this.$hostapi_url + "/sales/reports", formdata, this.$config)
          .then((res) => {
            this.isReport = true;
            this.customsale = res.data.orderSales;
            this.totalSale = res.data.totalSale;
            this.totalRevenue = res.data.totalRevenue;
            this.totaldiscount = res.data.totaldiscount;
            this.BarChart();
            this.PieChart();
            this.isLoading = false;
            $("#modal_id").modal("hide");
          });
      }
    },
    BarChart() {
      let dates = [];
      let totalsale = [];
      let totalactual = [];
      let total_profit = [];

      for (let index = 0; index < this.customsale.length; index++) {
        const element = this.customsale[index];
        dates.push(element.date);
        totalsale.push(element.totalsale);
        totalactual.push(element.totalactual);
        total_profit.push(element.total_profit);
      }
      var options = {
        colors: ["#7367F0", "#F5B041", "#28B463"],
        series: [
          {
            name: "Total Sales",
            data: totalsale,
          },
          {
            name: "Expense Cost",
            data: totalactual,
          },
          {
            name: "Revenue",
            data: total_profit,
          },
        ],
        chart: {
          type: "bar",
          height: 350,
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: "55%",
            endingShape: "rounded",
          },
        },
        dataLabels: {
          enabled: false,
        },
        stroke: {
          show: true,
          width: 2,
          colors: ["transparent"],
        },
        xaxis: {
          categories: dates,
        },
        yaxis: {
          title: {
            text: "Custom Sales Report",
          },
        },
        fill: {
          opacity: 1,
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return "Rs. " + val + " ";
            },
          },
        },
      };

      var chart = new ApexCharts(document.querySelector("#chart"), options);
      chart.render();
    },
    PieChart() {
      var options = {
        series: [this.totalSale, this.totalRevenue, this.totaldiscount],
        chart: {
          type: "donut",
        },
        labels: ["Sales", "Revenue", "Discount"],
        responsive: [
          {
            breakpoint: 480,
            options: {
              legend: {
                position: "bottom",
              },
            },
          },
        ],
      };

      var chart = new ApexCharts(
        document.querySelector("#weeklypieChart"),
        options
      );
      chart.render();
    },
  },
};
</script>

<style>
</style>
