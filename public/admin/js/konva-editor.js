const uploadBtn = document.getElementById('uploadBtn');
uploadBtn.addEventListener('click', () => {
    document.getElementById('imageBackground').click();
});
const form = document.getElementById('form');
form.addEventListener('submit', () => {
    toJson();
});

const MAX_WIDTH = 600;
const BACKGROUND_ID = 'background';
const AVATAR_ID = 'avatar';
const NAME_ID = 'name';
let stage = null;
let layer = null;
let transformer = null;
let imageBackground = null;
let avatarImage = null;
let nameText = null;
let currentSelection = null;
const initJson = document.getElementById('design').value;

loadJson(initJson);

function loadJson(json) {
    if (json && json !== '') {
        console.log(json);
        if (stage !== null) stage.destroy();
        stage = Konva.Node.create(json, 'container');
        layer = stage.getChildren().toArray()[0];
        layer.getChildren().each((node) => {
            if (node.id() !== BACKGROUND_ID) {
                addEventForNewObject(node);
                if (node.id() === AVATAR_ID) {
                    avatarImage = node;
                } else if (node.id() === NAME_ID) {
                    nameText = node;
                }
            } else imageBackground = node;
        });

        if (imageBackground) {
            // Load Background
            const bgImgObj = new Image();
            bgImgObj.onload = function () {
                imageBackground.image(bgImgObj);

                layer.draw();
            };
            bgImgObj.src = document.getElementById('image_link').value;
        }
    } else {
        stage = new Konva.Stage({
            container: 'container',
            width: MAX_WIDTH,
            height: MAX_WIDTH
        });
        layer = new Konva.Layer();
        stage.add(layer);

        imageBackground = new Konva.Image({
            id: BACKGROUND_ID,
            x: 0,
            y: 0,
            width: MAX_WIDTH,
            height: MAX_WIDTH
        });
        layer.add(imageBackground);

        avatarImage = new Konva.Image({
            id: AVATAR_ID,
            x: 20,
            y: 20,
            width: 200,
            height: this.height * 200 / this.width,
            draggable: true
        });
        layer.add(avatarImage);

        nameText = new Konva.Text({
            text: 'User name',
            id: NAME_ID,
            x: 20,
            y: 50,
            fontSize: 20,
            draggable: true,
            width: 100
        });

        layer.add(nameText);
        addEventForNewObject(nameText);
        layer.draw();
    }

    stage.content.style.outline = '1px solid black';
    stage.content.style.margin = 'auto';

    // Load Avatar
    const avaImgObj = new Image();
    avaImgObj.onload = function () {
        addEventForNewObject(avatarImage);
        avatarImage.image(avaImgObj);

        layer.draw();
    };
    avaImgObj.src = '/admin/images/user.png';
}

function createText() {
    const text = new Konva.Text({
        text: 'Double click to edit',
        x: 20,
        y: 0,
        fontSize: 20,
        draggable: true,
        width: 170
    });

    layer.add(text);
    layer.draw();

    addEventForNewObject(text);
}

function removeObject() {
    if (!currentSelection || currentSelection.id() === AVATAR_ID || currentSelection.id() === NAME_ID) return;
    currentSelection.destroy();
    removeSelection();
    currentSelection = null;
    layer.draw();
}

function addEventForText(text) {
    if (!(text instanceof Konva.Text)) return;


    text.on('transform', function () {
        // reset scale, so only with is changing by transformer
        text.setAttrs({
            width: text.width() * text.scaleX(),
            scaleX: 1
        });
    });

    text.on('dblclick', () => {
        text.hide();
        layer.draw();

        const textPosition = text.absolutePosition();

        const stageBox = stage.content.getBoundingClientRect();

        const areaPosition = {
            x: stageBox.left + textPosition.x,
            y: stageBox.top + textPosition.y
        };

        const textarea = document.createElement('textarea');
        document.body.appendChild(textarea);

        textarea.value = text.text();
        textarea.style.position = 'absolute';
        textarea.style.top = areaPosition.y + 'px';
        textarea.style.left = areaPosition.x + 'px';
        textarea.style.width = text.width() - text.padding() * 2 + 'px';
        textarea.style.height = text.height() - text.padding() * 2 + 5 + 'px';
        textarea.style.fontSize = text.fontSize() + 'px';
        textarea.style.border = 'none';
        textarea.style.padding = '0px';
        textarea.style.margin = '0px';
        textarea.style.overflow = 'hidden';
        textarea.style.background = 'none';
        textarea.style.outline = 'none';
        textarea.style.resize = 'none';
        textarea.style.lineHeight = `${text.lineHeight()}`;
        textarea.style.fontFamily = text.fontFamily();
        textarea.style.transformOrigin = 'left top';
        textarea.style.textAlign = text.align();
        textarea.style.color = text.fill();
        const rotation = text.rotation();
        let transform = '';
        if (rotation) {
            transform += 'rotateZ(' + rotation + 'deg)';
        }
        let px = 0;
        const isFirefox = navigator.userAgent.toLowerCase().indexOf('firefox') > -1;
        if (isFirefox) {
            px += 2 + Math.round(text.fontSize() / 20);
        }
        transform += 'translateY(-' + px + 'px)';
        textarea.style.transform = transform;
        textarea.style.height = 'auto';
        textarea.style.height = textarea.scrollHeight + 3 + 'px';
        textarea.focus();

        function removeTextarea() {
            textarea.parentNode.removeChild(textarea);
            window.removeEventListener('click', handleOutsideClick);
            text.show();
            layer.draw();
        }

        function setTextareaWidth(newWidth) {
            if (!newWidth) {
                newWidth = text.placeholder.length * text.fontSize();
            }
            const isSafari = /^((?!chrome|android).)*safari/i.test(
                navigator.userAgent
            );
            const isFirefox =
                navigator.userAgent.toLowerCase().indexOf('firefox') > -1;
            if (isSafari || isFirefox) {
                newWidth = Math.ceil(newWidth);
            }

            const isEdge =
                document.documentMode || /Edge/.test(navigator.userAgent);
            if (isEdge) {
                newWidth += 1;
            }
            textarea.style.width = newWidth + 'px';
        }

        textarea.addEventListener('keydown', function (e) {
            // hide on enter
            // but don't hide on shift + enter
            if (e.key === 'Enter' && !e.shiftKey) {
                text.text(textarea.value);
                removeTextarea();
            }
            // on esc do not set value back to node
            if (e.key === 'Escape') {
                removeTextarea();
            }
        });

        textarea.addEventListener('keydown', function () {
            let scale = text.getAbsoluteScale().x;
            setTextareaWidth(text.width() * scale);
            textarea.style.height = 'auto';
            textarea.style.height = textarea.scrollHeight + text.fontSize() + 'px';
        });

        function handleOutsideClick(e) {
            if (e.target !== textarea) {
                removeTextarea();
            }
        }

        setTimeout(() => {
            window.addEventListener('click', handleOutsideClick);
        });
    });
}

function selectBackground(input) {
    if (input.files && input.files[0]) {
        const imgObj = new Image();
        imgObj.onload = function () {
            let imageHeight = this.height * MAX_WIDTH / this.width;
            imageBackground.image(this);
            imageBackground.height(imageHeight);
            stage.height(imageHeight);
            layer.draw();
        };
        imageBackgroundUrl = URL.createObjectURL(document.getElementById('imageBackground').files[0]);
        imgObj.src = imageBackgroundUrl;
    }
}

function downloadURI(uri, name) {
    let link = document.createElement('a');
    link.download = name;
    link.href = uri;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    delete link;
}

function saveToImage() {
    removeSelection();
    const dataURL = stage.toDataURL({pixelRatio: 1});
    downloadURI(dataURL, 'result.png');
}

function toJson() {
    console.log(stage.toJSON());
    document.getElementById('design').value = stage.toJSON();
    console.log(imageBackgroundUrl);
}

function addEventForNewObject(object) {
    if (!object) return;

    object.on('click', function () {
        setSelection(object);
    });

    object.on('dragend', function() {
        object.x(Math.round(object.x()));
        object.y(Math.round(object.y()));
        layer.draw();
    });

    addEventForText(object);
}

function setSelection(object) {
    removeSelection();
    if (object instanceof Konva.Text) {
        transformer = new Konva.Transformer({
            id: 'transformer',
            node: object,
            rotateAnchorOffset: 0,
            anchorCornerRadius: 90,
            enabledAnchors: ['middle-left', 'middle-right'],
            boundBoxFunc: function (oldBox, newBox) {
                newBox.width = Math.max(30, newBox.width);
                return newBox;
            }
        });
    } else {
        transformer = new Konva.Transformer({
            id: 'transformer',
            node: object,
            rotateAnchorOffset: 0,
            anchorCornerRadius: 90,
            enabledAnchors: ['top-left', 'top-right', 'bottom-left', 'bottom-right'],
            boundBoxFunc: function (oldBox, newBox) {
                newBox.width = Math.max(30, newBox.width);
                return newBox;
            }
        });
    }
    layer.add(transformer);
    transformer.setZIndex(2);
    currentSelection = object;
    layer.draw();
    setTimeout(() => {
        window.addEventListener('click', handleOutsideClick);
    })
}

function removeSelection() {
    currentSelection = null;
    if (transformer) transformer.destroy();
    layer.draw();
    window.removeEventListener('click', handleOutsideClick);
}

function handleOutsideClick(e) {
    if (e.target !== currentSelection && currentSelection !== null) {
        removeSelection();
    }
}

// Add event when hold shift button then keep ratio transformer
stage.container().addEventListener('keydown', function () {
    if (e.keyCode === 16) {
        transformer.keepRatio(true);
    }
    e.preventDefault();
    layer.batchDraw();
});

stage.container().addEventListener('keyup', function () {
    if (e.keyCode === 16) {
        transformer.keepRatio(false);
    }
    e.preventDefault();
    layer.batchDraw();
});
