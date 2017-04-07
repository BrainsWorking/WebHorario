'use strict'

let sidebar = $('#sidebar')
let contents = $('#content')

sidebar.hover(
  () => { // Ao entrar
    sidebar.removeClass('collapsed-canvas');
    contents.removeClass('collapsed-canvas');
  },

  () => { // Ao sair
    sidebar.addClass('collapsed-canvas');
    contents.addClass('collapsed-canvas');
  }
)

