const qs = (selector, context = document) => context.querySelector(selector)
const qsa = (selector, context = document) => [...context.querySelectorAll(selector)]

const initNavigation = () => {
  const nav = qs('.site-nav')
  const toggle = qs('.nav-toggle', nav)
  const panel = qs('.site-nav__panel', nav)
  if (!nav || !toggle || !panel) return

  const close = () => {
    toggle.setAttribute('aria-expanded', 'false')
    nav.classList.remove('is-open')
  }

  toggle.addEventListener('click', () => {
    const expanded = toggle.getAttribute('aria-expanded') === 'true'
    toggle.setAttribute('aria-expanded', String(!expanded))
    nav.classList.toggle('is-open', !expanded)
  })
  qsa('a', panel).forEach((link) => link.addEventListener('click', close))
  document.addEventListener('keydown', (event) => event.key === 'Escape' && close())
}

const initVideoPlayer = () => {
  const player = qs('[data-video-player]')
  if (!player) return

  const iframe = qs('iframe', player)
  const title = qs('[data-video-title]', player)
  const type = qs('[data-video-type]', player)

  const selectVideo = (id, nextTitle = '', nextType = '') => {
    if (!id || !iframe) return
    iframe.src = `https://www.youtube-nocookie.com/embed/${encodeURIComponent(id)}?rel=0&autoplay=1`
    iframe.title = nextTitle || 'Video de María José'
    if (title && nextTitle) title.textContent = nextTitle
    if (type && nextType) type.textContent = nextType
    qsa('[data-video-id]').forEach((card) => card.setAttribute('aria-pressed', String(card.dataset.videoId === id)))
  }

  qsa('[data-video-id]').forEach((card) => {
    card.addEventListener('click', () => selectVideo(card.dataset.videoId, card.dataset.videoTitle, card.dataset.videoType))
  })
  qsa('[data-select-video]').forEach((link) => {
    link.addEventListener('click', () => {
      const card = qs(`[data-video-id="${CSS.escape(link.dataset.selectVideo)}"]`)
      selectVideo(link.dataset.selectVideo, card?.dataset.videoTitle, card?.dataset.videoType)
    })
  })
}

const initCarousels = () => {
  qsa('[data-carousel]').forEach((carousel) => {
    const track = qs('[data-carousel-track]', carousel)
    const step = () => Math.max(260, track.clientWidth * 0.72)
    qs('[data-carousel-prev]', carousel)?.addEventListener('click', () => track.scrollBy({ left: -step(), behavior: 'smooth' }))
    qs('[data-carousel-next]', carousel)?.addEventListener('click', () => track.scrollBy({ left: step(), behavior: 'smooth' }))
  })
}

const initReveal = () => {
  const items = qsa('[data-reveal]')
  if (!items.length || !('IntersectionObserver' in window)) {
    items.forEach((item) => item.classList.add('is-visible'))
    return
  }
  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (!entry.isIntersecting) return
      entry.target.classList.add('is-visible')
      observer.unobserve(entry.target)
    })
  }, { threshold: 0.14 })
  items.forEach((item) => observer.observe(item))
}

initNavigation()
initVideoPlayer()
initCarousels()
initReveal()

