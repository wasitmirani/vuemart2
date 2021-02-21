<template>
<div>
<Breadcrumb
      homeName="Dashboard"
      homeUrl="/"
      activeName="SEO Optimization"
      :breadcrumbbar="true"
    ></Breadcrumb>
 <!-- Table Hover Animation start -->
    <div class="row" id="table-hover-animation">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title" v-can="'SeoRead'">Seo Url List</h4>
          </div>
          <div class="card-body">
            <div class="card-text row">
              <div class="col-md-10 col-sm-6 col-xs-8">
                <div class="col-md-4">
                  <SearchInput
                    :apiurl="'seo?page=' + this.pageNum"
                    v-on:query="isquery($event)"
                    v-can="'SeoRead'"
                    v-on:isLoading="isLoadingStart($event)"
                    v-on:reload="getseo()"
                    v-on:dataList="searchData($event)"
                    label="Search Seo url"
                  ></SearchInput>
                </div>
              </div>

              <div class="col-md-2 col-sm-6 col-xs-4">
                <button
                  type="button"
                  v-can="'SeoCreate'"
                  class=".btn-sm btn-primary form-control"
                  @click="openPopup"
                  style="height: auto"
                >
                  New Seo
                </button>
              </div>
            </div>
          </div>
          <b-overlay :show="isLoading" variants="transparent" rounded="md"    v-can="'SeoRead'">
            <SeoList
              :seo="this.seo"
              :query="query"
              :getseo="getseo"
              v-can="'SeoRead'"
              v-on:editData="editData($event)"
              v-on:deleteData="deleteData($event)"
            ></SeoList>
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
            <h4 class="modal-title" v-if="!editMode">Create New SEO Optimization</h4>
            <h4 class="modal-title" v-else>Update SEO Optimization</h4>
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
            <SeoForm
              :editMode="editMode"
              v-can="'SeoCreate'"
              :editForm="editCollection"
              v-on:created="closePopup($event)"
              v-on:updated="closePopup($event)"
            ></SeoForm>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Breadcrumb from "../Breadcrumb/BreadcrumbComponent";

import SearchInput from "../Search/SearchFilterComponent";
import SeoForm from "./SeoFormComponent";
import SeoList from "./SeoListComponent";
export default {
  components: {
    Breadcrumb,
    SearchInput,
    SeoForm,
    SeoList,

  },
  data() {
    return {
      seo: {},
      staticList: {
        active: 0,
        total: 0,
        disable: 0,
        trashed: 0,
      },
      isLoading: false,
      pageNum: 1,
      query: "",
      editMode: false,
      editCollection: {},
    };
  },
  methods: {
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
        this.getseo();
        $("#modal_id").modal("hide");
      }
    },
    isquery(query) {
      return (this.query = query);
    },
    editData(item) {
      this.editMode = true;
      this.editCollection = item;
      $("#modal_id").modal("show");
    },
    searchData(data) {
      this.seo = data;
    },
    getseo(page = 1) {
      this.isLoading = true;
      this.page_num = page;
      axios
        .get(
          this.$hostapi_url + "/seo?page=" + page + "&query=" + this.query,
          this.$config
        )
        .then((res) => {

          this.seo = res.data;

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
            .delete(this.$hostapi_url + "/seo/" + item.id, this.$config)
            .then((res) => {
              this.getseo();
              Swal.fire("Deleted!", "Your file has been deleted.", "success");
            });
        }
      });
    },
  },
  mounted() {
    this.getseo();
  },
};
</script>

<style>
</style>
