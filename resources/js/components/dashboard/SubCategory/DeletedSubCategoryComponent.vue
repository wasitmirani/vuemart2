<template>
  <div>
    <Breadcrumb
      homeName="Dashboard"
      homeUrl="/"
      backName="Sub Categories"
      backUrl="/sub/categories"
      activeName="Trashed Categories"
      :breadcrumbbar="true"
    ></Breadcrumb>
    <!-- Table Hover Animation start -->
    <div class="row" id="table-hover-animation">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Trashed Sub Categories List</h4>
          </div>
          <div class="card-body">
            <div class="card-text row">
              <div class="col-md-10 col-sm-6 col-xs-8">
                <div class="col-md-4">
                  <SearchInput
                    :apiurl="'subcategory/trashed?page=' + this.pageNum"
                    v-on:query="isquery($event)"
                    v-on:isLoading="isLoadingStart($event)"
                    v-on:reload="getCategories()"
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

                    <th>Category</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="item in subCategories.data" :key="item.id">
                    <td>
                      <img
                        :src="item.thumbnailurl"
                        class="mr-75"
                        height="55"
                        width="40"
                        :alt="item.name"
                        v-if="(item.thumbnail != null) & (item.thumbnail != '')"
                      />
                      <vue-letter-avatar
                        :name="item.name"
                        class="mr-75"
                        size="30"
                        :rounded="true"
                        v-else
                      />
                      <span class="font-weight-bold">{{ item.name }}</span>
                    </td>

                    <td>
                      <div class="avatar-group" v-if="item.category!=null & item.category!=''">
                        <img
                          :src="item.category.thumbnailurl"
                          class="mr-75"
                          height="55"
                          width="40"
                          :alt="item.category.name"
                          v-if="
                            (item.category.thumbnail != null) &
                            (item.category.thumbnail != '')
                          "
                        />
                        <vue-letter-avatar
                          :name="item.category.name"
                          class="mr-75"
                          size="30"
                          :rounded="true"
                          v-else
                        />
                        <span
                          class="font-weight-bold"
                          style="margin-top: 6px"
                          >{{ item.category.name }}</span
                        >
                      </div>
                    </td>
                    <td>
                      <p :inner-html.prop="item.status | categoryStatus"></p>
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
      subCategories: {},
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
      this.subCategories = data;
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
              this.$hostapi_url + "/subcategory/restore?id=" + item.id,
              this.$config
            )
            .then((res) => {
              this.getCategories();
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
              this.$hostapi_url + "/subcategory/permanently/delete?id=" + item.id,
              this.$config
            )
            .then((res) => {
              this.getCategories();
              Swal.fire("Deleted!", "Your file has been Deleted.", "success");
            });
        }
      });
    },
    getCategories(page = 1) {
      this.isLoading = true;
      this.page_num = page;
      axios
        .get(
          this.$hostapi_url +
            "/subcategory/trashed?page=" +
            page +
            "&query=" +
            this.query,
          this.$config
        )
        .then((res) => {
          this.subCategories = res.data;
          this.isLoading = false;
        })
        .catch((er) => {
          //   console.log(er.response.data.errors);
        });
    },
  },
  mounted() {
    this.getCategories();
  },
};
</script>

<style>
</style>
