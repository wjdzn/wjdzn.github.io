$(function () {

    module("bootstrap-transition")

      test("should be defined on jquery support object", function () {
        ok($.support.transition !== undefined, 'transition object is defined')
      })

      test("should provide an end object", function () {
        ok($.support.transition ? $.support.transition.end : true, 'end string is defined')
      })

<<<<<<< HEAD
})
=======
})
>>>>>>> f9eb8f2935e210dc911e20d1ac3f5a5339b5f8e8
