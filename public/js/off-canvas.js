'use strict'

let offcanvas = $('#off-canvas')
let contents = $('#content')

offcanvas.hover(
  () => { // Entrar
    offcanvas.removeClass('collapsed-canvas');
    contents.removeClass('collapsed-canvas');
  },

  () => { // Sair
    offcanvas.addClass('collapsed-canvas');
    contents.addClass('collapsed-canvas');
  }
)

