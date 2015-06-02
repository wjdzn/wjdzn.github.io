module BootstrapWysihtml5Rails
  module Rails
    class Engine < ::Rails::Engine
      initializer "BootstrapWysihtml5Rails precompile hook", :group => :all do |app|
        app.config.assets.precompile += %w(bootstrap-wysihtml5.css bootstrap-wysihtml5.js bootstrap-wysihtml5/wysiwyg-color.css)
      end
    end
  end
<<<<<<< HEAD
end
=======
end
>>>>>>> f9eb8f2935e210dc911e20d1ac3f5a5339b5f8e8
