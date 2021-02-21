<template>
  <div>
    <Breadcrumb
      homeName="Dashboard"
      homeUrl="/"
      backName="Products"
      backUrl="/products"
      activeName="Trashed Products"
      :breadcrumbbar="true"
    ></Breadcrumb>
    <!-- Table Hover Animation start -->
    <div class="row" id="table-hover-animation">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Trashed Product List</h4>
          </div>
          <div class="card-body">
            <div class="card-text row">
              <div class="col-md-10 col-sm-6 col-xs-8">
                <div class="col-md-4">
                  <SearchInput
                    :apiurl="'category/trashed?page=' + this.pageNum"
                    v-on:query="isquery($event)"
                    v-on:isLoading="isLoadingStart($event)"
                    v-on:reload="getProducts()"
                    v-on:dataList="searchData($event)"
                    label="Search Deleted Categories"
                  ></SearchInput>
                </div>
              </div>

              <div class="col-md-2 col-sm-6 col-xs-4"></div>
            </div>
          </div>
          <b-overlay :show="isLoading" variants="transparent" rounded="md">
            <div class="table-responsive">
    <table class="table table-hover-animation">
      <thead>
        <tr>
          <th>Name</th>

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
          <td>
            <div class="d-flex align-items-center">
              <vue-letter-avatar :name="item.name" :rounded="true" />
              <div></div>
            </div>
            <div class="align-items-center font-weight-bolder">
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
                          title="Restore"
                          role="button"
                          class="waves-effect"
                          @click="restoreData(item)"
                          ><i class="fas fa-undo text-warning"></i
                        ></a>
                        |
                        <a
                          v-b-tooltip.hover
                          title="Permanently Delete"
                          role="button"
                          class="waves-effect"
                          @click="deleteData(item)"
                          ><i class="fas fa-trash-alt text-danger"></i
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
</b-overlay>

          <!-- Table -->
        </div>
      </div>
    </div>
    <!-- Table head options end -->
  </div>
</template>
</template>

<script>
import SearchInput from "../Search/SearchFilterComponent";
import Breadcrumb from "../Breadcrumb/BreadcrumbComponent";
export default {
  components: {
    Breadcrumb,
    SearchInput,
  },
  data() {
    return {
      products: {},
      isLoading: false,
      pageNum: 1,
      query: "",
    };
  },
  methods: {
    isquery(query) {
      return (this.query = query);
    },
    searchData(data) {
      this.categories = data;
    },
    isLoadingStart(value) {
      this.isLoading = value;
    },
    restoreData(item) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Restore it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .get(
              this.$hostapi_url + "/product/restore?id=" + item.id,
              this.$config
            )
            .then((res) => {
              this.getProducts();
              Swal.fire("Restored!", "Your file has been Restored.", "info");
            });
        }
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
        confirmButtonText: "Yes, permanently delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .get(
              this.$hostapi_url + "/product/permanently/delete?id=" + item.id,
              this.$config
            )
            .then((res) => {
              this.getProducts();
              Swal.fire("Deleted!", "Your file has been Deleted.", "success");
            });
        }
      });
    },
    getProducts(page = 1) {
      this.isLoading = true;
      this.page_num = page;
      axios
        .get(
          this.$hostapi_url +
            "/product/trashed?page=" +
            page +
            "&query=" +
            this.query,
          this.$config
        )
        .then((res) => {
          this.products = res.data;
          this.isLoading = false;
        })
        .catch((er) => {
          //   console.log(er.response.data.errors);
        });
    },
  },
  mounted() {
    this.getProducts();
  },
};
</script>

<style>
</style>
