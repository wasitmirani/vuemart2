<template>
  <div class="table-responsive">
    <table class="table table-hover-animation">
      <thead>
        <tr>
          <th>Name</th>
            <th></th>
               <th></th>
          <th>Featured</th>
          <th>Category</th>
          <th>Sub Category</th>
          <th>Units InStock</th>
          <th>Actual Price</th>
          <th>Unit Price</th>
          <th>Discount Price</th>
          <th>Price</th>
          <th>Description</th>
          <th>Created</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in products.data" :key="item.id">
<td colspan="3">
            <div class="d-flex align-items-center">
              <div
                class="avatar rounded"
                v-if="(item.product_images[0].thumbnail != null) & (item.product_images[0].thumbnail!= '')"
              >
                <div class="avatar-content">
                  <b-img-lazy
                    v-bind="mainProps"
                    :src="$base_url+'/admin/img/products/'+item.product_images[0].thumbnail"
                    rounded
                    alt=""
                  ></b-img-lazy>
                </div>
              </div>
              <vue-letter-avatar
                :name="item.name"
                class="mr-75"
                size="40"
                :rounded="true"
                v-else
              />

            </div>
              <div class="align-items-center font-weight-bolder mt-2">
              {{ item.name + "-" }}
              <span class="text-primary"> {{ item.quantityPerUnit }}</span>
            </div>
          </td>
          <td>
            <p :inner-html.prop="item.isfeatured | isfeatured"></p>
          </td>
           <td>

            <p v-if="item.category!=null & item.cateogry!='' "> {{ item.category.name }}</p>
             <span v-else>N/A</span>
          </td>
          <td>
      <p v-if="item.subcategory!=null & item.subcategory!='' "> {{ item.subcategory.name }}</p>
      <span v-else>N/A</span>
          </td>
          <td>
            <p :inner-html.prop="item.unitsInStock | isUnitStock"></p>
          </td>
          <td>
            <span>${{ item.actualPrice }}</span>
          </td>
          <td>
            <span>${{ item.unitPrice }}</span>
          </td>
          <td>
            <span>${{ item.discount_price }}</span>
          </td>
          <td>
            <span>${{ item.unitPrice - item.discount_price }}</span>
          </td>
          <td>
            <div v-if="item.description!=null & item.description!=''">


            <span v-if="item.description.length > 50">{{
              item.description.slice(0, 50) + "...."
            }}</span>
            <span v-else>{{ item.description }}</span>
        </div>
            <span v-else>{{ item.description }}</span>
          </td>
          <td>
            <span>{{ item.created_at | timeformat }}</span>
          </td>

          <td>
            <h5>
              <a
                v-b-tooltip.hover
                title="Edit"
                role="button"
                 v-can="'ProductUpdate'"
                @click="editData(item)"
                ><i class="fas fa-edit text-primary"></i
              ></a>
              |
              <a
                v-b-tooltip.hover
                title="Delete"
                role="button"
                v-can="'ProductDelete'"
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
            :data="products"
            :limit="2"
            @pagination-change-page="getProducts"
          ></pagination>
        </ul>
      </nav>
    </div>
  </div>
</template>

<script>
export default {
  props: ["products", "getProducts", "query"],
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
    deleteData: function (item) {
      return this.$emit("deleteData", item);
    },
    editData: function (item) {
      return this.$emit("editData", item);
    },
  },
};
</script>

