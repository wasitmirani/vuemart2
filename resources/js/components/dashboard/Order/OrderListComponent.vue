<template>
  <div class="table-responsive" v-can="'OrderRead'">
    <table class="table table-hover-animation">
      <thead>
        <tr>
          <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Address</th>
           <th>Order Note</th>
            <th>Sub Total</th>
            <th>Discount</th>
            <th>Total</th>
          <th>Status</th>
            <th>Created</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in orders.data" :key="item.id">
          <td>
            <div class="d-flex align-items-center">

              <vue-letter-avatar
                :name="item.name"

                size="40"
                :rounded="true"

              />



            </div>
              <div class="font-weight-bolder ">{{ item.name }}</div>
          </td>

         <td>
            <span>{{ item.user_phone}}</span>
          </td>
          <td>
            <span>{{ item.user_email}}</span>
          </td>
            <td>
            <small>{{ item.address}}</small>
          </td>
           <td>
            <span>{{ item.order_notes}}</span>
          </td>
           <td>
            <span>${{ item.total_unitprice}}</span>
          </td>
             <td>
            <span>${{ item.total_discount}}</span>
          </td>
           <td>
            <span>${{item.total_unitprice - item.total_discount}}</span>
          </td>
          <td>
            <p :inner-html.prop="item.status | orderStatus"></p>
            <a
             v-if="item.status==1"
                v-b-tooltip.hover
                title="Accept Order"
                role="button"
                v-can="'OrderAccept'"
                @click="orderAccept(item)"
                ><i class="fas fa-check text-success"></i
              >
              |
              </a>
            <a
                 v-if="item.status==1"
                v-b-tooltip.hover
                title="Cancel Order"
                role="button"
                v-can="'OrderCancel'"
                @click="orderCancel(item)"
                ><i class="fas fa-trash text-danger"></i
              ></a>
          </td>
            <td>
         <span>{{item.created_at | timeformat }}</span>
          </td>
          <td >
            <h5>


              <a
                v-b-tooltip.hover
                title="Edit"
                role="button"
                  v-can="'OrderPrint'"
                @click="printOrder(item)"
                ><i class="fas fa-print text-primary"></i
              ></a>
              |
              <a
                v-b-tooltip.hover
                title="Delete"
                role="button"
                  v-can="'OrderDelete'"
                @click="deleteData(item)"
                ><i class="fas fa-trash text-danger"></i
              ></a>
            </h5>
          </td>
        </tr>
      </tbody>
    </table>
    <hr />
    <div class="justify-content-center ml-4">
      <nav aria-label="Page navigation example">
        <ul class="pagination pagination-danger mt-2">
          <pagination
            :data="orders"
            :limit="2"
            @pagination-change-page="getorders"
          ></pagination>
        </ul>
      </nav>
    </div>
  </div>
</template>

<script>
export default {
  props: ["orders", "getorders", "query"],
  data() {
    return {
      mainProps: {
        blank: false,
        blankColor: "#777",
        width: 60,
        height: 60,
        class: "m1",
      },
    };
  },
  methods: {
      printOrder(order){
          window.location.href=this.$base_url+"/print/order/"+order.id;
          },
      orderAccept:function(item){
        return this.$emit("orderAccept",item);
      },
      orderCancel:function(item){
        return this.$emit("orderCancel",item);
      },
    deleteData: function (item) {
      return this.$emit("deleteData", item);
    },
    printData: function (item) {
      return this.$emit("printData", item);
    },
  },
};
</script>
