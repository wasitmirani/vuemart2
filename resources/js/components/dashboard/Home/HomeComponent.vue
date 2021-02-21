<template>
<div>
     <div class="content-header row">

        <div class="content-body">
            <!-- Dashboard Ecommerce Starts -->
            <section >
                <div class="row match-height">
                    <!-- Medal Card -->
                    <div class="col-xl-3 col-md-3 col-12">
                        <div class="card card-congratulation-medal">
                            <div class="card-body" v-if="this.customer[1]!=null & this.customer[1]!=''">
                                <h5>Congratulations 🎉 {{this.customer[1].name}} </h5>
                                <p class="card-text font-small-3">Value Buyer <strong class="text-warning">{{this.customer[1].name}}</strong> </p>
                                 <p class="card-text font-small-3">Phone <span>{{this.customer[1].user_phone}}</span> </p>
                                <h3 class="mb-75 mt-2 pt-50">
                                    <h6>Top purchaser   <span class="text-warning">{{this.customer[1].name}}</span></h6>
                                    <a href="javascript:void(0);">${{this.customer[0].totalpurchase}}</a>
                                </h3>

                                <img src="app-assets\images\illustration\badge.svg" class="congratulation-medal"
                                    alt="Medal Pic">
                            </div>
                        </div>
                    </div>
                    <!--/ Medal Card -->

                    <!-- Statistics Card -->
                    <div class="col-xl-6 col-md-6 col-12" v-can="'SaleReportView'">
                        <div class="card card-statistics">
                            <div class="card-header">
                                <h4 class="card-title">Daily Statistics</h4>
                                <div class="d-flex align-items-center">
                                    <p class="card-text font-small-2 mr-25 mb-0">Updated {{ new Date().toJSON().slice(0,10).replace(/-/g,'-') }}</p>
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
                                                <h4 class="font-weight-bolder mb-0">${{ this.todaysales}}</h4>
                                                <p class="card-text font-small-3 mb-0">Sales</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                        <div class="media">
                                            <div class="avatar bg-light-info mr-2">
                                                <div class="avatar-content">
                                                    <i data-feather="user" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="media-body my-auto">
                                                <h4 class="font-weight-bolder mb-0">{{this.todayusers}}</h4>
                                                <p class="card-text font-small-3 mb-0">Customers</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                        <div class="media">
                                            <div class="avatar bg-light-danger mr-2">
                                                <div class="avatar-content">
                                                    <i data-feather="box" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="media-body my-auto">
                                                <h4 class="font-weight-bolder mb-0">{{this.todayproducts}}</h4>
                                                <p class="card-text font-small-3 mb-0">Products</p>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="col-xl-5 col-sm-6 col-12">
                                        <div class="media">
                                            <div class="avatar bg-light-success mr-2">
                                                <div class="avatar-content">
                                                    <i data-feather="dollar-sign" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="media-body my-auto">
                                                <h4 class="font-weight-bolder mb-0">${{this.todayRevenue}}</h4>
                                                <p class="card-text font-small-3 mb-0">Revenue</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="col-lg-3 col-md-3 col-12">
                        <div class="card card-developer-meetup">
                            <div class="meetup-img-wrapper rounded-top text-center">
                                <img src="app-assets\images\illustration\email.svg" alt="Meeting Pic" height="170">
                            </div>
                            <div class="card-body">
                                <div class="meetup-header d-flex align-items-center">
                                    <div class="meetup-day">
                                        <!-- <h6 class="mb-0">THU</h6>
                                        <h3 class="mb-0">24</h3> -->
                                    </div>
                                    <div class="my-auto">
                                           <h4 class="card-title mb-25">Hi, {{auth_user.name}}</h4>
                                        <p class="card-text mb-0">{{auth_user.email}}</p>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="avatar bg-light-primary rounded mr-1">
                                        <div class="avatar-content">
                                            <i data-feather="calendar" class="avatar-icon font-medium-3"></i>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <h6 class="mb-0">{{new Date()}}</h6>
                                        <!-- <small>10:AM to 6:PM</small> -->
                                    </div>
                                </div>
                                <!-- <div class="media mt-2">
                                    <div class="avatar bg-light-primary rounded mr-1">
                                        <div class="avatar-content">
                                            <i data-feather="map-pin" class="avatar-icon font-medium-3"></i>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <h6 class="mb-0">Central Park</h6>
                                        <small>Manhattan, New york City</small>
                                    </div>
                                </div> -->

                            </div>
                        </div>
                    </div>
                    <!--/ Statistics Card -->
                </div>

                <div class="row match-height" v-can="'SaleReportView'">
                    <div class="col-lg-12 col-12">
                        <div class="row match-height">
                            <!-- Bar Chart - Orders -->
                            <div class="col-lg-8 col-sm-12 col-md-12 col-8">
                                <div class="card">
                                    <div class="card-body pb-50">
                                        <h6>Last 7 Days Orders</h6>
                                        <h2 class="font-weight-bolder mb-1">${{totalweeklySale}}</h2>
                                        <div id="chart"></div>

                                    </div>
                                </div>
                            </div>
                            <!--/ Bar Chart - Orders -->



                            <!-- Earnings Card -->
                            <div class="col-lg-4 col-md-6 col-12" v-can="'SaleReportView'">
                                <div class="card earnings-card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <h4 class="card-title mb-1">Earnings</h4>
                                                <div class="font-small-2">Last 7 Days Orders</div>
                                                <h5 class="mb-1 mt-2">${{weeklyRevenue}}</h5>
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

                            <!--/ Earnings Card -->
                        </div>
                    </div>
                </div>

                <div class="row match-height" v-can="'OrdersView'">
                    <!-- Company Table Card -->
                    <div class="col-lg-12 col-12">
                        <div class="card card-company-table">
                            <div class="card-body p-0">
                              <h2  class="mt-4 mb-4 ml-4">Today Order's</h2>
                            <OrderList
                            :orders="this.gettodayOrders"
                            :query="''"
                            :getorders="todayOrders"
                            v-on:orderCancel="orderCancel($event)"
                            v-on:orderAccept="orderAccept($event)"
                            v-on:printData="printData($event)"
                            v-on:deleteData="deleteData($event)"
                            ></OrderList>
                            </div>
                        </div>
                    </div>
                    <!--/ Company Table Card -->

                    <!-- Developer Meetup Card -->

                    <!--/ Developer Meetup Card -->

                    <!-- Browser States Card -->

                    <!--/ Goal Overview Card -->

                    <!-- Transaction Card -->

                    <!--/ Transaction Card -->
                </div>
            </section>
            <!-- Dashboard Ecommerce ends -->

        </div>
    </div>
</div>

</template>

<script>
import OrderList from "../Order/OrderListComponent";



export default {
    components: {
    OrderList,
  },
data(){
    return {
    weeklysale:[],
    weeklydiscount:0,
    customer:{},
    gettodayOrders:{},
    auth_user:{},
    totalweeklySale:0,
    todaysales:0,
    todayusers:0,
    todayproducts:0,
    todayRevenue:0,
    weeklyRevenue:0,
    }
},
methods:{
     orderAccept(item){
        axios.get(this.$hostapi_url+"/order/status?value="+2+"&id="+item.id,this.$config).then((res)=>{
            this.todayOrders();
            this.getDashboardData();
        });
    },
    orderCancel(item){
        axios.get(this.$hostapi_url+"/order/status?value="+0+"&id="+item.id,this.$config).then((res)=>{
            this.todayOrders();
            this.getDashboardData();
        });
    },
    todayOrders(){
        let page=1;
        axios.get(this.$hostapi_url+'/today-orders?page=' + page,this.$config).then((res)=>{
        this.gettodayOrders=res.data;
        });


    },
    getDashboardData(){
        axios.get(this.$hostapi_url + "/dashboard",this.$config).then((res)=>{

            this.weeklysale=res.data.weeklySale;
            this.totalweeklySale=res.data.totalSale;
            this.customer=res.data.customer;
            this.todaysales=res.data.todaySales;
            this.todayRevenue=res.data.todayRevenue;
            this.todayusers=res.data.todayUsers;
            this.todayproducts=res.data.todayproducts;
            this.weeklyRevenue=res.data.weeklyRevenue;
            this.weeklydiscount=res.data.weeklydiscount;
            this.orderChart();
            this.weeklyEarningsPieChart();

        });
    },
    weeklyEarningsPieChart(){
          var options = {
          series: [this.totalweeklySale,  this.weeklyRevenue,    this.weeklydiscount],
          chart: {
          type: 'donut',
        },
        labels: ['Sales', 'Revenue', 'Discount'],
        responsive: [{
          breakpoint: 480,
          options: {

            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#weeklypieChart"), options);
        chart.render();
    },
    orderChart(){
        let dates=[];
        let totalsale=[];
        let totalactual=[];
        let total_profit=[];
        console.log(this.weeklysale.length)
        for (let index = 0; index < this.weeklysale.length; index++) {
            const element = this.weeklysale[index];
            dates.push(element.date);
            totalsale.push(element.totalsale);
            totalactual.push(element.totalactual);
            total_profit.push(element.total_profit);
        }
        var options = {
         colors : ['#7367F0', '#F5B041','#28B463'],
          series: [{
          name: 'Total Sales',
          data: totalsale
        }, {
          name: 'Expense Cost',
          data: totalactual
        }, {
          name: 'Revenue',
          data: total_profit
        }],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: dates,
        },
        yaxis: {
          title: {
            text: 'Weekly Sale'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return "Rs. " + val + " "
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    }
},
mounted(){
    this.getDashboardData();
    this.todayOrders();
            this.auth_user = this.$attrs["authuser"];
}
}
</script>

<style>

</style>
