import {
    Scene,
    PerspectiveCamera,
    WebGLRenderer,
    BoxGeometry,
    MeshBasicMaterial,
    Mesh,
    Vector3,
    AxesHelper,
    AmbientLight,
    DirectionalLight,
    Box3,
    Line,
    LineBasicMaterial,
    BufferGeometry,
    CircleGeometry,
    PlaneGeometry,
    BufferAttribute,
    Color,
} from "./three.js-master/build/three.module.js";
import {
    OBJLoader2
} from './three.js-master/examples/jsm/loaders/OBJLoader2.js';
import {
    MTLLoader
} from "./three.js-master/examples/jsm/loaders/MTLLoader.js";
import {
    OrbitControls
} from "./three.js-master/examples/jsm/controls/OrbitControls.js";


import {
    MtlObjBridge
} from './three.js-master/examples/jsm/loaders/obj2/bridge/MtlObjBridge.js';


const TAU = 2 * Math.PI;
const E_X = new Vector3(1, 0, 0);
const E_Y = new Vector3(0, 1, 0);
const E_Z = new Vector3(0, 0, 1);
const LINE_WIDTH = 40;
const PATH_POINTS = [
    [ 1320.75228086,     0.        ,  -251.93173124],
    [ 1356.74982158,     0.        ,  -501.92944991],
    [ 1265.89888548,     0.        ,  -807.48221717],
    [ 1231.61551336,     0.        , -1088.72965066],
    [ 1247.04303081,     0.        , -1475.87889554],
    [ 1444.17242048,     0.        , -1687.6825183 ],
    [ 1692.72686832,     0.        , -2010.59623824],
    [ 1727.01024044,     0.        , -2274.48271906],
    [ 1691.01269972,     0.        , -2543.57748568],
    [ 1692.72686832,     0.        , -2831.76930025],
    [ 1925.85379871,     0.        , -2830.03320498],
    [ 2124.69735698,     0.        , -2826.56101445],
    [ 2126.41152559,     0.        , -2536.6331046 ],
    [ 2129.8398628 ,     0.        , -2277.9549096 ],
    [ 1922.4254615 ,     0.        , -2272.74662379],
    [ 1727.01024044,     0.        , -2274.48271906],
    [ 1483.59829841,     0.        , -2118.23414489],
    [ 1289.89724596,     0.        , -2113.02585909],
    [ 1295.03975178,     0.        , -2357.81529195],
    [ 1293.32558317,     0.        , -2607.81301061],
    [ 1094.4820249 ,     0.        , -2625.1739633 ],
    [  763.64748398,     0.        , -2611.28520115],
    [  760.21914677,     0.        , -2847.39415767],
    [  789.36001306,     0.        , -3104.33625741],
    [  566.51809431,     0.        , -3100.86406687],
    [  789.36001306,     0.        , -3104.33625741],
    [  760.21914677,     0.        , -2847.39415767],
    [  763.64748398,     0.        , -2611.28520115],
    [  758.50497816,     0.        , -2484.55024655],
    [  758.50497816,     0.        , -2352.60700614],
    [  761.93331537,     0.        , -2114.76195436],
    [  763.64748398,     0.        , -1849.13937827],
    [  768.78998979,     0.        , -1576.57242112],
    [  777.36083282,     0.        , -1310.94984503],
    [  770.5041584 ,     0.        , -1050.53555476],
    [  511.66469892,     0.        ,  -718.94135847],
    [  515.09303614,     0.        ,  -271.02877919],
];


const INTERMEDIATES = [
    [ 2124.69735698,     0.        , -2826.56101445],
    [ 1727.01024044,     0.        , -2274.48271906],
    [ 1925.85379871,     0.        , -2830.03320498],
    [ 1094.4820249 ,     0.        , -2625.1739633 ],
    [  566.51809431,     0.        , -3100.86406687]
];


/**
 * RGB to hex int color representation.
 */
function hex_color(red, green, blue) {
    return (red << 16) + (green << 8) + blue;
}


const ORANGE = hex_color(224, 102, 20);
const RED = hex_color(255, 0, 0);
const GREEN = hex_color(0, 255, 0);



/**
 * Create orbit controls.
 */
function init_controls(camera, renderer) {
    const controls = new OrbitControls(camera, renderer.domElement);
    controls.enableZoom = true;
    controls.autoRotate = false;
    controls.autoRotateSpeed = 1.;
    return controls;
}


/**
 * Add lightning to scene.
 */
function setup_lightning(scene) {
    var ambient = new AmbientLight(0x444444);
    scene.add(ambient);

    var directionalLight = new DirectionalLight(0xffeedd);
    //directionalLight.position.set( 0, 0, 1 ).normalize();
    directionalLight.position.set(0, 1, 0).normalize();
    scene.add(directionalLight);
}


/**
 * Load Migros moon store model into scene.
 */
function load_model(scene) {
    var mtlLoader = new MTLLoader();
    //mtlLoader.setBaseUrl( 'obj/fil' );
    //mtlLoader.setPath( 'obj/fil' );
    mtlLoader.load(
        'Filiale.mtl',
        //'VT1-2_FFK_B_Rendering_ohne_Ware.mtl',
        function(matResults) {
            console.log('MTL loaded');
            matResults.preload();
            var objLoader = new OBJLoader2();
            const materials = MtlObjBridge.addMaterialsFromMtlLoader(matResults);
            //materials.Material.side = DoubleSide;
            objLoader.addMaterials(materials);
            objLoader.load('Filiale.obj',
                /**
                 * On load callback.
                 */
                function(object) {
                    scene.add(object);
                },

                /**
                 * On progresses callback.
                 */
                function(xhr) {
                    console.log((xhr.loaded / xhr.total * 100) + '% loaded');
                },

                /*
                 * On error
                 */
                function(error) {
                    console.log('An error happened');
                }
            );
        }
    );
}



/**
 * Convert 3d array to Vector3.
 */
function make_vector3(pt) {
    return new Vector3(pt[0], pt[1], pt[2]);
}


/**
 * Draw path
 */
function draw_path(scene, points, color) {
    // Calc triangle segments for line through points with LINE_WIDTH
    var lw = LINE_WIDTH;
    var n = points.length;
    var vertices = [];
    var start = make_vector3(points[0]);
    for(var i=1; i<n; i++) {
        var end = make_vector3(points[i]);
        var line = end.clone().sub(start);
        var offset = line.clone().cross(E_Y).normalize();
        var right = offset.clone().multiplyScalar(.5 * lw);
        var left = offset.clone().multiplyScalar(-.5 * lw);

        var a = start.clone().add(right);
        var b = end.clone().add(right);
        var c = start.clone().add(left);
        var d = end.clone().add(left);

        vertices.push(a);
        vertices.push(b);
        vertices.push(c);

        vertices.push(d);
        vertices.push(c);
        vertices.push(b);

        start = end;
    }

    // Flatten (.flat() did not work)
    var data = [];
    vertices.forEach(function(v) {
        data.push(v.x);
        data.push(v.y);
        data.push(v.z);
    });

    // Create line mesh
    const verticesArray = new Float32Array(data);
    const geometry = new BufferGeometry();
    const vbo = new BufferAttribute(verticesArray, 3)
    geometry.setAttribute('position', vbo);
    const material = new MeshBasicMaterial({
        color: color,
        //side: THREE.DoubleSide,
    });
    const lineMesh = new Mesh(geometry, material);
    scene.add( lineMesh );
}



function draw_disc(scene, position, color) {
    var geometry = new CircleGeometry( 80, 32 );
    geometry.rotateX(-.25 * TAU);
    var material = new MeshBasicMaterial( {
        color: color,
    });
    var circle = new Mesh( geometry, material );
    circle.position.set(position[0], position[1], position[2]);
    scene.add( circle );
}


function draw_axis(scene) {
    var axesHelper = new AxesHelper( 1000 );
    scene.add( axesHelper );
}


/**
 * Load three model and visualize Migros moon store.
 */
export function visualize_store(canvas) {
    var scene = new Scene();
    scene.background = new Color( 0xffffff );

    {
        const fov = 75;
        //const fov = 10;
        const aspect = window.innerWidth / window.innerHeight;
        const near = 0.1;
        const far = 10000;
        //const far = 1000000;
        var camera = new PerspectiveCamera(fov, aspect, near, far);
    }

    var renderer = new WebGLRenderer({
        canvas: canvas,
        antialias: true,
    });
    renderer.setSize(window.innerWidth, window.innerHeight);

    // Position camera and controls
    var center = new Vector3(
        //1178.6991405, 165., -1878.2367355
        2382 / 2, 530/2, -3805 / 2,
    );
    camera.position.set(
        //1200, 1000, 2000
        //2382 / 2 + 200, 1000, 1500,
        2382 / 2 + 200, 2400, 1200,
    );
    camera.lookAt(center);
    const controls = init_controls(camera, renderer);
    controls.target.copy(center);

    load_model(scene);

    setup_lightning(scene);

    //draw_axis(scene);

    draw_path(scene, PATH_POINTS, ORANGE);
    INTERMEDIATES.forEach(function(pos) {
        draw_disc(scene, pos, ORANGE);
    });

    draw_disc(scene, PATH_POINTS[0], GREEN);
    draw_disc(scene, PATH_POINTS[PATH_POINTS.length - 1], RED);

    renderer.render(scene, camera);

    var animate = function() {
        requestAnimationFrame(animate);
        renderer.render(scene, camera);
        controls.update();
    }

    animate();
}
