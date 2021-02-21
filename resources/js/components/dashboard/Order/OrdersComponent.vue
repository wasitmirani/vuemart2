<template>
  <div>
    <Breadcrumb
      homeName="Dashboard"
      homeUrl="/"
      activeName="Order's"
      :breadcrumbbar="true"
    ></Breadcrumb>
     <div class="row" v-can="'OrderRead'">
      <div class="col-lg-12 col-12">
        <div class="card card-statistics">
          <div class="card-header">
            <h4 class="card-title">Order's Statistics</h4>
            <div class="d-flex align-items-center">
              <p class="card-text mr-25 mb-0">Over view</p>
            </div>
          </div>
          <div class="card-body statistics-body">
            <div class="row">
              <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                <div class="media">
                  <div class="avatar bg-light-primary mr-2">
                    <div
                      class="avatar-content"
                      v-b-tooltip.hover
                      title="Total orders"
                    >
                      <i class="fab fa-buffer avatar-icon"></i>
                    </div>
                  </div>
                  <div class="media-body my-auto">
                    <h4 class="font-weight-bolder mb-0">
                      {{ this.staticList.total }}
                    </h4>
                    <p class="card-text font-small-3 mb-0">Total</p>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                <div class="media">
                  <div class="avatar bg-light-success mr-2">
                    <div
                      class="avatar-content"
                      v-b-tooltip.hover
                      title="Accepted orders"
                    >
                      <i class="fab fa-buffer avatar-icon"></i>
                    </div>
                  </div>
                  <div class="media-body my-auto">
                    <h4 class="font-weight-bolder mb-0">
                      {{ this.staticList.Accepted }}
                    </h4>
                    <p class="card-text font-small-3 mb-0">Accepted</p>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-12 mb-2 mb-sm-0">
                <div class="media">
                  <div class="avatar bg-light-danger mr-2">
                    <div
                      class="avatar-content"
                      v-b-tooltip.hover
                      title="Cancel orders"
                    >
                      <i class="fab fa-buffer avatar-icon"></i>
                    </div>
                  </div>
                  <div class="media-body my-auto">
                    <h4 class="font-weight-bolder mb-0">
                      {{ this.staticList.cancel }}
                    </h4>
                    <p class="card-text font-small-3 mb-0">Cancel</p>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-12">

                  <div class="media">
                    <div class="avatar bg-light-warning mr-2">
                      <div
                        class="avatar-content"
                        v-b-tooltip.hover
                        title="Pending orders"
                      >
                        <i class="fab fa-buffer avatar-icon"></i>
                      </div>
                    </div>
                    <div class="media-body my-auto">
                      <h4 class="font-weight-bolder mb-0">
                        {{ this.staticList.pending }}
                      </h4>
                      <p class="card-text font-small-3 mb-0">Pending</p>
                    </div>
                  </div>

              </div>
            </div>
          </div>
        </div>
      </div>


    </div>

    <!-- Table Hover Animation start -->
    <div class="row" id="table-hover-animation">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Order List</h4>
          </div>
          <div class="card-body">
            <div class="card-text row">
              <div class="col-md-10 col-sm-6 col-xs-8">
                <div class="col-md-4">
                  <SearchInput
                    :apiurl="'order?page=' + this.pageNum+'&dateby='+this.dateby"
                    v-can="'OrderRead'"
                    v-on:query="isquery($event)"
                    v-on:isLoading="isLoadingStart($event)"
                    v-on:reload="getorders()"
                    v-on:dataList="searchData($event)"
                    label="Search Order"
                  ></SearchInput>
                </div>
              </div>

              <div class="col-md-2 col-sm-6 col-xs-4"  v-can="'OrderRead'">
                  <div class="invoice_status ml-sm-2">
                      <select  class="form-control ml-50 text-capitalize" v-model="dateby" @change="getByDate">
                          <option value="4"> All </option>
                          <option value="1" class="text-capitalize">Today</option>
                          <option value="2" class="text-capitalize">Yesterday</option>
                          <option value="3" class="text-capitalize">Last Month</option>


                  </select></div>
              </div>
            </div>
          </div>
          <b-overlay :show="isLoading" variants="transparent" rounded="md"  v-can="'OrderRead'">
            <OrderList
              :orders="this.orders"
              :query="query"
              :getorders="getorders"
              v-on:orderCancel="orderCancel($event)"
             v-on:orderAccept="orderAccept($event)"
              v-on:printData="printData($event)"
              v-on:deleteData="deleteData($event)"
            ></OrderList>
          </b-overlay>

          <!-- Table -->
        </div>
      </div>
    </div>
    <!-- Table head options end -->
  </div>
</template>

<script>

import Breadcrumb from "../Breadcrumb/BreadcrumbComponent";

import SearchInput from "../Search/SearchFilterComponent";
import OrderList from "../Order/OrderListComponent";

export default {
  components: {
    Breadcrumb,
    SearchInput,
    OrderList,
  },
  data() {
    return {
      orders: {},
      staticList: {
        Accepted: 0,
        total: 0,
        cancel: 0,
        pending: 0,
      },
      dateby:4,
      isLoading: false,
      orderStatusShow:false,
      pageNum: 1,
      query: "",
      editMode: false,
      editCollection: {},
    };
  },
  methods:{
      getByDate(){
          console.log(this.dateby);
        //   if(this.dateby=="1" || this.dateby=="2")
          this.getorders();
      },
    isLoadingStart(value) {
      this.isLoading = value;
    },
    openPopup() {
      this.editMode = false;
      this.editCollection = null;
      $("#modal_id").modal("show");
    },
    closePopup(item) {
      if (item) {
        this.getorders();
        $("#modal_id").modal("hide");
      }
    },
    isquery(query) {
      return (this.query = query);
    },
    printData(item) {
      this.editMode = true;
      this.editCollection = item;
      $("#modal_id").modal("show");
    },
    orderAccept(item){
        axios.get(this.$hostapi_url+"/order/status?value="+2+"&id="+item.id,this.$config).then((res)=>{
            this.getorders();
        });
    },
    orderCancel(item){
        axios.get(this.$hostapi_url+"/order/status?value="+0+"&id="+item.id,this.$config).then((res)=>{
            this.getorders();
        });
    },
    searchData(data) {
      this.orders = data.orders;
    },
    getorders(page = 1) {
      this.isLoading = true;
      this.page_num = page;
      axios
        .get(
          this.$hostapi_url + "/order?page=" + page + "&query=" + this.query+"&dateby="+this.dateby,
          this.$config
        )
        .then((res) => {
          this.orders = res.data.orders;
          this.staticList.Accepted = res.data.Accepted;
          this.staticList.total = res.data.total;
          this.staticList.cancel = res.data.cancel;
          this.staticList.pending = res.data.pending;
          this.isLoading = false;
        })
        .catch((er) => {
          //   console.log(er.response.data.errors);
        });
    },

    deleteData(item) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .delete(this.$hostapi_url + "/order/" + item.id, this.$config)
            .then((res) => {
              this.getorders();
              Swal.fire("Deleted!", "Your file has been deleted.", "success");
            });
        }
      });
    },
},
  mounted() {
    this.getorders();
  },

}
</script>

<style>

</style>
