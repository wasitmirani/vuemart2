<template>
    <!-- BEGIN: Content-->

        <div class="content-header row" v-show="breadcrumbbar">
          <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h2 class="content-header-title float-left mb-0">{{activeName}}</h2>
                <div class="breadcrumb-wrapper">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><router-link :to="homeUrl">{{homeName}}</router-link>
                    </li>
                    <li class="breadcrumb-item" v-if="backName!=null & backName!=''"><router-link :to="backUrl">{{backName}}</router-link>
                    </li>
                    <li class="breadcrumb-item active">{{activeName}}
                    </li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
        </div>
</template>

<script>
export default {
 props: ['homeName','homeUrl','backName','backUrl','activeName','breadcrumbbar']
}
</script>

<style>

</style>
