class MainController < ApplicationController
  
  def index
    @dir = Dir.open("/home/freire/SIM")
  end
  
  def diretorio
    if params[:diretorio].nil?
      @dir = Dir.open(params[:diretorio])
      render :partial => "diretorio", :locals=> {:dir=>@dir}
    end
  end
  
end
