<template>
  <div class="mt-5">
    <h2>حجز موعد</h2>
    <form>
      <div>
        <label>الاسم:</label>
        <input type="text" class="form-control" />
      </div>
      <div class="mt-3">
        <label>رقم الهاتف:</label>
        <input type="text" class="form-control" />
      </div>
      <div class="mt-3">
        <label>تاريخ الموعد:</label>
        <input type="date" class="form-control" />
      </div>
      <div class="mt-3">
        <button class="btn btn-primary">إرسال</button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  name: "AppointmentForm"
}
</script>
