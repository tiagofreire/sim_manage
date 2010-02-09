ActionController::Routing::Routes.draw do |map|
  map.diretorio "/main/diretorio", :controller=>"main", :action=>"diretorio" 
  map.root :controller => "main"
  map.connect ':controller/:action/:id'
  map.connect ':controller/:action/:id.:format'
end
